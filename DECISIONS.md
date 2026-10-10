# Design
1. Left block of KRI_Categories.xlsx = official catalogue (15 KRIs, 64 Sub-KRIs)
2. kris and sub_kris are fixed reference tables, seeded from CSV
3. Each risk maps to ONE KRI and ONE Sub-KRI (columns on risk_registers)
4. LPU approval applies to a risk-to-Sub-KRI assignment (kri_approvals)
5. Admin does not edit the catalogue
6. Duplicate imports detected using imported_hash (no risk number in the file)
7. Risk level bands are placeholders until confirms