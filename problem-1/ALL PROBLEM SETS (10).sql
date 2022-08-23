#1# SELECT * FROM WORKERS WHERE SALARY < 1000;

#2# SELECT name,documentery FROM WORKERS,OFFICE WHERE WORKERS.`office-id` = OFFICE.`office-id`;

#3# SELECT AVG( WORKERS.salary),  OFFICE.`office-id` FROM WORKERS,office WHERE workers.`office-id` = office.`office-id` GROUP BY office.`office-id`; 

#4# SELECT documentery FROM office,SECTION WHERE office.`section-id` = section.`section-id` AND SECTION.city = "esfehan";

#5# SELECT section.`name`,COUNT(office.`section-id`) FROM section, office WHERE section.`section-id` = office.`section-id` GROUP BY section.`section-id`;

#6# SELECT workers.`name`,section.`name` FROM section, office, workers WHERE workers.`office-id` = office.`office-id` AND office.`section-id` = section.`section-id`  GROUP BY workers.`person-id`; # manam fekr kardam eshtebahe ta nim saat

#7# SELECT AVG(workers.`SALARY`),section.`CITY` FROM section, office, workers WHERE workers.`office-id` = office.`office-id` AND office.`section-id` = section.`section-id` AND section.`CITY` = "esfehan" ;

#8# SELECT SECTION.`name`,COUNT(workers.`person-id`) FROM section, office, workers WHERE workers.`office-id` = office.`office-id` AND office.`section-id` = section.`section-id` GROUP BY section.`section-id`;

### SELECT OFFICE.documentery,COUNT(workers.`person-id`) FROM office,section,workers WHERE section.`section-id` = office.`section-id` AND workers.`office-id` = office.`office-id` AND section.city = "esfehan" GROUP BY office.`office-id`; # left join do the trick # ITS A BROKEN TRY XXX

#9# SELECT	office.documentery, 	COUNT(workers.`person-id`) FROM	workers	RIGHT JOIN	office	ON 		workers.`office-id` = office.`office-id`	INNER JOIN	section	ON 		office.`section-id` = section.`section-id` WHERE	section.city = "ESFEHAN" GROUP BY	office.documentery;

#10# SELECT SECTION.`name`,COUNT(workers.`person-id`) FROM section, office, workers WHERE workers.`office-id` = office.`office-id` AND office.`section-id` = section.`section-id`  GROUP BY section.`section-id` HAVING COUNT(WORKERS.`person-id`)>10;


