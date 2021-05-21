SELECT 
s.`last_name`,s.`first_name`,s.`middle_name`, s.`sno`,
i.`last_name`,i.`first_name`,i.`middle_name`, 
r.`ref_no`, r.`year_level_id`,r.`transac_date`
FROM 04SEM_01LKS_210209.`reservations` r
LEFT JOIN 00SER_01LKS_201015.`students` s ON (s.id=r.`account_id`)
LEFT JOIN 04SEM_01LKS_210209.`inquiries` i ON (i.`id`=r.`account_id`)
WHERE r.`transac_date` >= '2021-02-01' AND r.`transac_date` <= '2021-04-01'