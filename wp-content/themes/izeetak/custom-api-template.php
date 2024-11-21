<?php
/*
 Template Name: Custom API Template
 */
?>

<?php get_header(); ?>

<!-- Your custom code here -->
<div class="category-tree-container">
    <h3>Select API List</h3>
    <div id="category-tree"></div>
</div>

<?php
// Fetch categories
$categories = get_categories(array('hide_empty' => false));

$category_tree = array();

// Build the category tree
foreach ($categories as $category) {
    // Check if this category has a parent
    if ($category->parent == 0) {
        $category_tree[] = array(
            'id' => $category->term_id,
            'text' => $category->name,
            'children' => array()
        );
    } else {
        // Find the parent category and add this category as its child
        foreach ($category_tree as &$parent_category) {
            if ($parent_category['id'] == $category->parent) {
                $parent_category['children'][] = array(
                    'id' => $category->term_id,
                    'text' => $category->name,
                );
                break;
            }
        }
    }
}

// Convert categories to a JSON format for jsTree
$category_tree_json = json_encode($category_tree);
?>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        // Initialize jsTree with the categories data
        $('#category-tree').jstree({
            "core": {
                "data": <?php echo $category_tree_json; ?>
            },
            "plugins": ["checkbox"] // Enable checkbox plugin
        });
    });
</script>



<?php get_footer(); ?>
