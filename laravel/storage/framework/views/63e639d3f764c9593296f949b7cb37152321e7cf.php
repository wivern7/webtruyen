<?xml version="1.0" encoding="UTF-8"?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
<!-- created by Dinh Quoc Han -->
    <url>
        <loc><?php echo e(url('/')); ?></loc>
        <changefreq>daily</changefreq>
        <lastmod><?php echo e(date('c')); ?></lastmod>
        <priority>0.8</priority>
    </url>
    <?php if($categories): ?>
        <?php foreach($categories as $category): ?>
            <url>
                <loc><?php echo e(route('category.list.index',$category->alias)); ?></loc>
                <changefreq>monthly</changefreq>
                <lastmod><?php echo e($category->updated_at->format('c')); ?></lastmod>
                <priority>0.6</priority>
            </url>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php if($authors): ?>
        <?php foreach($authors as $author): ?>
            <url>
                <loc><?php echo e(route('author.list.index',$author->alias)); ?></loc>
                <changefreq>monthly</changefreq>
                <lastmod><?php echo e($author->updated_at->format('c')); ?></lastmod>
                <priority>0.6</priority>
            </url>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php if($stories): ?>
        <?php foreach($stories as $story): ?>
            <url>
                <loc><?php echo e(route('story.show',$story->alias)); ?></loc>
                <changefreq>weekly</changefreq>
                <lastmod><?php echo e($story->updated_at->format('c')); ?></lastmod>
                <priority>0.8</priority>
            </url>
        <?php endforeach; ?>
    <?php endif; ?>
</urlset>
