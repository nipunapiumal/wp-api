// jQuery(document).ready(function ($) {
//     $('#category-tree').jstree({
//         'core': {
//             'data': categoryTreeData, // Load tree data from PHP
//             'themes': {
//                 'dots': true, // Show connecting dots
//                 'icons': false // Disable default icons
//             }
//         },
//         'plugins': ['checkbox'], // Enable checkboxes
//     });

//     // Log selected categories
//     $('#category-tree').on('changed.jstree', function (e, data) {
//         let selectedIds = data.selected;
//         console.log('Selected Categories:', selectedIds);
//     });
// });


jQuery(document).ready(function ($) {
    $('#category-tree').jstree({
        'core': {
            'data': categoryTreeData,
            'themes': {
                'dots': true, // Show connecting dots
                'icons': false // Disable default icons
            }
        },
        'plugins': ['checkbox'], // Enable checkboxes
    });

    // Log selected categories
    $('#category-tree').on('changed.jstree', function (e, data) {
        let selectedIds = data.selected;
        console.log('Selected Categories:', selectedIds);
    });
});
