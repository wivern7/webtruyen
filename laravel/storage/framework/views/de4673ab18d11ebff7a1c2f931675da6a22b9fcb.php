<div class="list list-truyen list-cat col-xs-12">
    <div class="title-list"><h4>Thể loại truyện</h4></div>
    <div class="row">
        <?php
        $categories = \App\Category::select('id', 'name', 'alias', 'parent_id')->orderBy('id', 'DESC')->get();
        foreach($categories as $category)
            echo '<div class="col-xs-6"><a href="'. route('category.list.index', ['alias' => $category->alias]) .'">'. $category->name .'</a></div>';
        ?>
    </div>
</div>