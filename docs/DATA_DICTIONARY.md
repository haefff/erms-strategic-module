# Data Dictionary: e-RMS Strategic Module

Database: `erms_strategic_module` (MySQL)

## 1. ptjs
Responsibility centres (PTJ).

| Column | Type | Null | Description |
|---|---|---|---|
| id (PK) | bigint | No | Unique PTJ ID |
| name | varchar(255), unique | No | PTJ name |
| code | varchar(30), unique | Yes | Optional PTJ code |
| created_at, updated_at | timestamp | Yes | Record timestamps |

## 2. users
System accounts (Laravel default columns plus role fields).

| Column | Type | Null | Description |
|---|---|---|---|
| id (PK) | bigint | No | Unique user ID |
| name | varchar(255) | No | Full name |
| email | varchar(255), unique | No | Login email |
| password | varchar(255) | No | Hashed password |
| role | varchar(20) | No | `admin` or `lpu` (default `lpu`) |
| ptj_id (FK) | bigint | Yes | References ptjs.id |
| is_active | boolean | No | Account active status (default true) |
| created_at, updated_at | timestamp | Yes | Record timestamps |

## 3. kris
KRI catalogue (15 fixed KRIs).

| Column | Type | Null | Description |
|---|---|---|---|
| id (PK) | bigint | No | Unique KRI ID |
| number | tinyint, unique | No | KRI number (1-15) |
| name | varchar(255) | No | KRI name |
| description | text | Yes | KRI description |
| created_at, updated_at | timestamp | Yes | Record timestamps |

## 4. sub_kris
Sub-KRI catalogue (64 fixed Sub-KRIs).

| Column | Type | Null | Description |
|---|---|---|---|
| id (PK) | bigint | No | Unique Sub-KRI ID |
| kri_id (FK) | bigint | No | References kris.id |
| code | varchar(10), unique | No | Sub-KRI code (for example 8.4) |
| name | varchar(255) | No | Sub-KRI name |
| description | text | Yes | Sub-KRI description |
| created_at, updated_at | timestamp | Yes | Record timestamps |

## 5. risk_registers
Imported risk records and their KRI assignment.

| Column | Type | Null | Description |
|---|---|---|---|
| id (PK) | bigint | No | Unique risk ID |
| ptj_id (FK) | bigint | No | References ptjs.id |
| risk_number | varchar(50) | Yes | Risk number, if present in the file |
| year | smallint | No | Risk year (Tahun) |
| risk_description | text | No | Keterangan Risiko |
| risk_owner | varchar(255) | Yes | Pemilik Risiko |
| registered_date | date | Yes | Tarikh Daftar |
| updated_date | date | Yes | Tarikh Kemaskini |
| likelihood | tinyint | Yes | Kebarangkalian (P6) |
| human_impact | tinyint | Yes | Impak Manusia (P1) |
| reputation_impact | tinyint | Yes | Impak Reputasi (P2) |
| financial_impact | tinyint | Yes | Impak Kewangan (P3) |
| operational_impact | tinyint | Yes | Impak Operasi (P4) |
| objective_impact | tinyint | Yes | Impak Objektif (P5) |
| average_score | decimal(5,2) | Yes | Purata of P1 to P5 |
| risk_index | decimal(6,2) | Yes | Indeks Risiko |
| risk_level | varchar(30) | Yes | Tahap Risiko |
| existing_controls | text | Yes | Kawalan Sedia Ada |
| proposed_controls | text | Yes | Kawalan Tambahan Dicadangkan |
| status | varchar(100) | Yes | Status |
| category | varchar(100) | Yes | Kategori |
| marker | varchar(100) | Yes | Penanda |
| classification | varchar(100) | Yes | Klassifikasi |
| is_high_impact | boolean | No | High-impact flag (default false) |
| high_impact_set_by (FK) | bigint | Yes | References users.id |
| high_impact_set_at | timestamp | Yes | When it was flagged |
| kri_id (FK) | bigint | Yes | Assigned KRI, references kris.id |
| sub_kri_id (FK) | bigint | Yes | Assigned Sub-KRI, references sub_kris.id |
| import_hash | char(64), unique | Yes | Hash used to detect duplicate imports |
| created_at, updated_at | timestamp | Yes | Record timestamps |

## 6. risk_updates
Change log for risk records.

| Column | Type | Null | Description |
|---|---|---|---|
| id (PK) | bigint | No | Unique log ID |
| risk_register_id (FK) | bigint | No | References risk_registers.id |
| user_id (FK) | bigint | Yes | User who made the change |
| field_changed | varchar(100) | No | Name of the changed field |
| old_value | text | Yes | Value before |
| new_value | text | Yes | Value after |
| remarks | varchar(255) | Yes | Optional note |
| created_at, updated_at | timestamp | Yes | Record timestamps |

## 7. kri_approvals
LPU approval of a risk-to-Sub-KRI assignment.

| Column | Type | Null | Description |
|---|---|---|---|
| id (PK) | bigint | No | Unique approval ID |
| risk_register_id (FK) | bigint | No | References risk_registers.id |
| kri_id (FK) | bigint | Yes | Proposed KRI |
| sub_kri_id (FK) | bigint | Yes | Proposed Sub-KRI |
| submitted_by (FK) | bigint | Yes | Admin who submitted |
| reviewed_by (FK) | bigint | Yes | LPU user who reviewed |
| status | varchar(20) | No | `pending`, `approved` or `rejected` |
| remarks | text | Yes | Reviewer remarks |
| submitted_at | timestamp | Yes | Submission time |
| reviewed_at | timestamp | Yes | Review time |
| created_at, updated_at | timestamp | Yes | Record timestamps |

## 8. reports
Log of generated reports.

| Column | Type | Null | Description |
|---|---|---|---|
| id (PK) | bigint | No | Unique report ID |
| user_id (FK) | bigint | Yes | User who generated it |
| title | varchar(255) | No | Report title |
| report_type | varchar(50) | No | Type of report |
| filters | json | Yes | Filters used |
| file_format | varchar(20) | Yes | `pdf` or `xlsx` |
| file_path | varchar(255) | Yes | Saved file location |
| status | varchar(20) | No | Report status (default `generated`) |
| generated_at | timestamp | Yes | Generation time |
| created_at, updated_at | timestamp | Yes | Record timestamps |