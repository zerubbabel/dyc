# Thinkphp
---
## left join
```php
	 $members=$model->table('zhope_card A')
        ->join('zhope_user U ON A.adduser=U.id')
        ->join('zhope_tpl T ON A.tpl=T.id')
        ->field('A.id AS I,A.cid AS Card_id,U.name AS Creator,T.name AS Tpl_name')
        ->select();
```

```php
$model = M("Admin");
$admin_list = $model->alias("m")->join(C('DB_PREFIX').'gadmin c ON m.admin_gid=c.gid','LEFT')->order('m.admin_id desc')->limit($page->firstRow.','.$page->listRows)->select();
```

```php
$Model->join('LEFT JOIN work ON artist.id = work.artist_id')->select();
```
