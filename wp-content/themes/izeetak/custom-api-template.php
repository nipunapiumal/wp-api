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
// Recursive function to fetch categories hierarchically
function get_hierarchical_categories($parent_id = 0) {
    $categories = get_categories([
        'parent'     => $parent_id,
        'hide_empty' => false,
    ]);

    $tree = [];
    foreach ($categories as $category) {
        $tree[] = [
            'id'       => $category->term_id,
            'name'     => $category->name,
            'children' => get_hierarchical_categories($category->term_id),
        ];
    }
    return $tree;
}

// Pass the hierarchical data to JavaScript
// $category_tree_data = get_hierarchical_categories();

// dump($category_tree_data);
$categories = [
    ["id" => 1, "name" => "Blog", "children" => []],
    ["id" => 2, "name" => "Cloud Computing", "children" => []],
    ["id" => 3, "name" => "Custom Software", "children" => []],
    ["id" => 4, "name" => "Cyber Security", "children" => []],
    ["id" => 5, "name" => "IT Consultancy", "children" => []],
    ["id" => 6, "name" => "IT Support", "children" => []],
    ["id" => 7, "name" => "Managed IT", "children" => []],
    ["id" => 8, "name" => "Uncategorized", "children" => []]
];

$categoryTreeData = array_map(function($category) {
    return [
        'id' => $category['id'],
        'text' => $category['name'],
        'children' => $category['children']
    ];
}, $categories);

//echo json_encode($categoryTreeData);


?>
<script>
    // var categoryTreeData = <?php echo json_encode($category_tree_data); ?>;
</script>
<script>
    let categoryTreeData = <?php echo json_encode($categoryTreeData); ?>;

</script>

<?php
// Recursive function to display categories as a tree
function display_category_tree($categories, $parent_id = 0) {
    echo '<ul>';
    foreach ($categories as $category) {
        if ($category->parent == $parent_id) {
            echo '<li>';
            echo '<input type="checkbox" id="category-' . $category->term_id . '" name="categories[]" value="' . $category->term_id . '">';
            echo '<label for="category-' . $category->term_id . '">' . $category->name . '</label>';

            // Check for child categories
            $child_categories = array_filter($categories, function ($cat) use ($category) {
                return $cat->parent == $category->term_id;
            });

            if (!empty($child_categories)) {
                display_category_tree($categories, $category->term_id);
            }

            echo '</li>';
        }
    }
    echo '</ul>';
}

// Fetch all categories
$args = array(
    'hide_empty' => false,
    'orderby'    => 'name',
    'order'      => 'ASC',
);
$categories = get_categories($args);

// Render the category tree
echo '<div class="category-tree">';
display_category_tree($categories);
echo '</div>';

?>


<?php get_footer(); ?>
