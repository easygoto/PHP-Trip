select gid, sum(num)
from ((select goods_id as gid, sum(goods_num) as num from order_goods GROUP BY goods_id ORDER BY goods_id)
      union all (select id as gid, inventory as num from goods)) as subt
group by subt.gid
order by gid