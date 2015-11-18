$( document ).ready(function( $ ) {
    var sortable = $('.sortable');
    sortable.nestedSortable({
        handle: 'div',
        items: 'li',
        toleranceElement: '> div',
        rootID: '0',
        // Once item has been moved to final destination, the 'relocate' event is triggered
        relocate: function () {  
            serialize = sortable.nestedSortable('serialize');
            $('#serializeOutput').val(serialize);
        }
    });
    $('#addPage').click(function(){
        var title = $('#select2-Form-field-MenuBackend-pages-container').attr('title');
        if ((typeof(title) !== 'undefined') && (title !== null)) {
            // seems to require the 'toString', otherwise typeError with the string replace function...
            var str = /\(.*\)/.exec(title).toString();
            var page = str.replace(/\(|\)/g,"");
            var uniqueID = (new Date()).getTime();
            sortable.append('<li id="' + page + '_' + uniqueID + '"><div class="menuDiv"><span title="Click to show/hide children" class="disclose ui-icon ui-icon-minusthick"></span>' + page + '<span title="Click to delete item." data-id="' + page + '_' + uniqueID + '" class="deleteMenu ui-icon ui-icon-closethick"></span></div></li>');
            sortable.nestedSortable('refresh');
            // update the pseudo-serialized input value
            serialize = sortable.nestedSortable('serialize');
            $('#serializeOutput').val(serialize);
        }
    });
    // Delegate to a static wrapper element for dynamically added elements
    sortable.on('click', '.disclose', function() {
        if ($( this ).parent().parent().children().has( "li" ).length > 0) {
            $(this).closest('li').toggleClass('mjs-nestedSortable-collapsed').toggleClass('mjs-nestedSortable-expanded');
            $(this).toggleClass('ui-icon-plusthick').toggleClass('ui-icon-minusthick');
        }
    });
    sortable.on('click', '.deleteMenu', function () {
        var id = $(this).attr('data-id');
        $('#'+id).remove();
        $(this).request('onRemoveContent', {data: {content_block_name: $(this).attr('data-name')}});
    });
});

function mySerialize(){
    serialize = $('.sortable').nestedSortable('serialize');
	$('#serializeOutput').val(serialize);
}

function addContent(data){
    var form_control = $('input#Form-field-MenuBackend-content_url.form-control');
	if ( data.test === "1") {
	    form_control.addClass('invalid');
		var title = $('#select2-Form-field-MenuBackend-contents-container').attr('title');
		if ((typeof(title) !== 'undefined') && (title !== null)) {
			var str = /\(.*\)/.exec(title).toString();
			var content = str.replace(/\(|\)/g,"");
			var uniqueID = (new Date()).getTime() + data.cid;
			var sortable = $('.sortable');
			sortable.append('<li id="' + content + '_' + uniqueID + '"><div class="menuDiv con_block"><span title="Click to show/hide children" class="disclose ui-icon ui-icon-minusthick"></span>' + content + ' <i class="fa fa-newspaper-o" title="October content block"></i><span title="Click to delete item." data-id="' + content + '_' + uniqueID + '"  data-name="' + content + '" class="deleteMenu ui-icon ui-icon-closethick"></span></div></li>');
			sortable.nestedSortable('refresh');
			// update the pseudo-serialized input value
			serialize = sortable.nestedSortable('serialize');
			$('#serializeOutput').val(serialize);
		}
	} else {
		form_control.addClass('invalid');
		form_control.effect("highlight", {}, 4000);
    }
}
