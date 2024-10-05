consulta pivote 

SELECT 
    p.ci,
    p.nombre,
    p.apellido,
    MAX(CASE WHEN LEFT(c.codigo_catastral, 1) = '1' THEN 'Alto' ELSE NULL END) AS Impuesto_Alto,
    MAX(CASE WHEN LEFT(c.codigo_catastral, 1) = '2' THEN 'Medio' ELSE NULL END) AS Impuesto_Medio,
    MAX(CASE WHEN LEFT(c.codigo_catastral, 1) = '3' THEN 'Bajo' ELSE NULL END) AS Impuesto_Bajo
FROM 
    Propietarios p
JOIN 
    Catastro c ON p.ci = c.ci
GROUP BY 
    p.ci, p.nombre, p.apellido;