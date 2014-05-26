$('#container').waterfall({
    itemCls: 'item',
    colWidth: 222,  
    gutterWidth: 15,
    gutterHeight: 15,
    checkImagesLoaded: false,
    path: function(page) {
        return 'users/jsonify_all';
    },

    callbacks: {
       renderData: function (data) {
           var template = $('#waterfall-tpl').html();

           return Mustache.to_html(template, data).replace(/^\s*/mg, '')
       }
    }
});
