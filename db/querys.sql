SELECT 
    v.id AS id_venda,
    v.cod_prod,
    p.valor,
    p.categoria,
    p.quantidade AS quantidade_produto,
    v.id_vendedor,
    u.nome AS nome_vendedor,
    v.id_cliente,
    c.nome AS nome_cliente,
    v.created_at AS data_venda,
    v.sts_pay,
    v.sts_sell,
    v.mtd_pay
FROM 
    venda v
INNER JOIN 
    produtos p ON v.cod_prod = p.cod
INNER JOIN 
    clientes c ON v.id_cliente = c.id
INNER JOIN 
    usuarios u ON v.id_vendedor = u.id;