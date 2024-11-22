<?php
/*
 Template Name: Custom API Template
 */
?>

<?php get_header(); ?>

<!-- Your custom code here -->
<div class="category-tree-container">
    <form method="POST" id="category-form">
        <h3>Select API List</h3>
        <div id="category-tree"></div>
        <button type="submit" id="submit-button" class="api-button-text">Submit</button>
    </form>
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
        // Initialize jsTree
        $('#category-tree').jstree({
            "core": {
                "data": <?php echo $category_tree_json; ?> // Pass category data to jsTree
            },
            "plugins": ["checkbox"] // Enable checkbox plugin
        });

        // Handle form submission
        $('#category-form').on('submit', function(e) {
            e.preventDefault(); // Prevent default form submission
            
            // Get checked categories
            var selectedCategories = $('#category-tree').jstree('get_checked');
            
            // Log the selected categories
            console.log("Selected Categories:", selectedCategories);

            // Process the selected categories (e.g., send via AJAX)
            // $.ajax({
            //     url: '<?php echo admin_url("admin-ajax.php"); ?>',
            //     method: 'POST',
            //     data: {
            //         action: 'process_selected_categories',
            //         selected_categories: selectedCategories
            //     },
            //     success: function(response) {
            //         console.log("Server Response:", response);
            //     },
            //     error: function(error) {
            //         console.error("Error:", error);
            //     }
            // });
        });
    });
</script>






<?php get_footer(); ?>
