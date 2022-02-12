
$(window).on('load', function() {
	// Row Toggler
	// -----------------------------------------------------------------
	$('#demo-foo-row-toggler').footable();

	// Accordion
	// -----------------------------------------------------------------
	$('#demo-foo-accordion').footable().on('footable_row_expanded', function(e) {
		$('#demo-foo-accordion tbody tr.footable-detail-show').not(e.row).each(function() {
			$('#demo-foo-accordion').data('footable').toggleDetail(this);
		});
	});

	// Accordion
	// -----------------------------------------------------------------
	$('#demo-foo-accordion2').footable().on('footable_row_expanded', function(e) {
		$('#demo-foo-accordion2 tbody tr.footable-detail-show').not(e.row).each(function() {
			$('#demo-foo-accordion').data('footable').toggleDetail(this);
		});
	});

	// Pagination & Filtering
	// -----------------------------------------------------------------
	$('[data-page-size]').on('click', function(e){
		e.preventDefault();
		var newSize = $(this).data('pageSize');
		FooTable.get('#demo-foo-pagination').pageSize(newSize);
	});
	$('#demo-foo-pagination').footable();

	$('#demo-foo-addrow').footable();
	
    var addrow = $('#demo-foo-addrow2');
	addrow.footable().on('click', '.delete-row-btn', function() {

		//get the footable object
		var footable = addrow.data('footable');

		//get the row we are wanting to delete
		var row = $(this).parents('tr:first');

		//delete the row
		footable.removeRow(row);
	});


	// Add & Remove Row
	//https://fooplugins.github.io/FooTable/docs/content/columns.json
	//https://fooplugins.github.io/FooTable/docs/content/rows.json
	// -----------------------------------------------------------------
	var $modal = $('#editor-modal'),
		$editor = $('#editor'),
		$editorTitle = $('#editor-title'),
		ft = FooTable.init('#footable-addrow', {
			columns: $.get('http://localhost/test2/Social_ARS/assets/json/getColumns.json'),
			rows: $.get('http://localhost/test2/Social_ARS/assets/json/getRows.json'),	
			editing: {
				enabled: false,
			}	
		}),
		uid = 10001;
	/*
	$editor.on('submit', function(e){
		if (this.checkValidity && !this.checkValidity()) return;
		e.preventDefault();
		var row = $modal.data('row'),
			values = {
				firstName: $editor.find('#firstName').val(),
				lastName: $editor.find('#lastName').val(),
				jobTitle: $editor.find('#jobTitle').val(),
				dob: moment($editor.find('#dob').val(), 'YYYY-MM-DD'),
				status: $editor.find('#status').val()
			};

		if (row instanceof FooTable.Row){
			row.val(values);
		} else {
			values.id = uid++;
			ft.rows.add(values);
		}
		$modal.modal('hide');
	});*/

});
