<?php if (!defined('THINK_PATH')) exit();?><a href="/admin/index/add">添加</a>
<table>
    <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
            <td><?php echo ($vo["id"]); ?></td>
            <td><?php echo ($vo["name"]); ?></td>
            <td><?php echo ($vo["shopName"]); ?></td>
            <td><?php echo ($vo["status"]); ?></td>
            <td><a href="/admin/index/edit?id=<?php echo ($vo["id"]); ?>">编辑</a></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>