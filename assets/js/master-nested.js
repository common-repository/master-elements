let m = jQuery;
let w = window;

// Elementor Classes and Functions Used in this File
m(document).ready(function () {
    if (w.elementor) {
        meViewFilter(elementor);
        elementor.hooks.addFilter('elements/column/contextMenuGroups', NestOptionToMenu)
    }
});

function AddNestedSections(me_element) {

    let elementor_object_view = me_element.getContainer().view;
    if (elementor_object_view.getElementType() === 'column') {
        elementor_object_view.addElement(createArgs(elementor));
    }

}

function NestOptionToMenu(nest, me_element) {

    let el_index = nest.findIndex(function (nest_item) {
        return 'addNew' === nest_item.name;
    });

    nest[el_index].actions.push({
        name: 'master-add-nested-section',
        title: 'Add Nested Section',
        icon: 'eicon-clone',
        callback: function () {
            AddNestedSections(me_element);
        },
        isEnabled: function () {
            return true;
        }
    });

    return nest

}

function meViewFilter(e) {
    e.hooks.addFilter('element/view', function (group_elements, me_element) {

        if (me_element.get('elType') === 'column') {
            return group_elements.extend({
                getContextMenuGroups: function () {
                    return group_elements.prototype.getContextMenuGroups.apply(this, arguments);
                }
            })
        }

        return group_elements;
    });
}

function createArgs(e) {
    let args = {
        elType: 'section',
        isInner: true,
        settings: {},
        elements: [{
            id: e.helpers.getUniqueID(),
            elType: 'column',
            isInner: true,
            settings: {
                _column_size: 100
            },
            elements: []
        }]
    };
    return args;
}
