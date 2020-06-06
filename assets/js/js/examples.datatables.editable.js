// /*
// Name: 			Tables / Editable - Examples
// Written by: 	Okler Themes - (http://www.okler.net)
// Theme Version: 	2.0.0
// */
//
// (function($) {
//
// 	'use strict';
//
// 	var example1 = {
//
// 		options: {
// 			addButton: '#addToTable',
// 			table: '#example1',
// 			dialog: {
// 				wrapper: '#dialog',
// 				cancelButton: '#dialogCancel',
// 				confirmButton: '#dialogConfirm',
// 			}
// 		},
//
// 		initialize: function() {
// 			this
// 				.setVars()
// 				.build()
// 				.events();
// 		},
//
// 		setVars: function() {
// 			this.$table				= $( this.options.table );
// 			this.$addButton			= $( "#add_movie");
//
// 			// dialog
// 			this.dialog				= {};
// 			this.dialog.$wrapper	= $( this.options.dialog.wrapper );
// 			this.dialog.$cancel		= $( this.options.dialog.cancelButton );
// 			this.dialog.$confirm	= $( this.options.dialog.confirmButton );
//
// 			return this;
// 		},
//
// 		build: function() {
// 			this.datatable = this.$table.DataTable({
// 				// dom: '<"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>p',
// 				dom: 'lfBrtip',
// 				buttons: [
// 					// 'excel', 'pdf', 'print'
// 					{
// 						extend: 'excel',
// 						exportOptions: {
// 							columns: [ 0, 1, 2, 3, 4]
// 						},
// 					},
// 					{
// 						extend: 'pdf',
// 						exportOptions: {
// 							columns: [ 0, 1, 2, 3, 4]
// 						},
// 					},
// 					{
// 						extend: 'print',
// 						exportOptions: {
// 							columns: [ 0, 1, 2, 3, 4]
// 						},
// 					}
// 				],
// 				aoColumns: [
// 					null,
// 					null,
// 					null,
// 					null,
// 					null,
// 					{ "bSortable": false }
// 				]
// 			});
//
// 			window.dt = this.datatable;
//
// 			return this;
// 		},
//
// 		events: function() {
// 			var _self = this;
//
// 			this.$table
// 				.on('click', 'a.save-row', function( e ) {
// 					e.preventDefault();
// 					var values = [], th_names = [], send_values = [];
// 					var $row = $(this).closest( 'tr' );
// 					values = $row.find('td').map(function() {
// 						var $this = $(this);
//
// 						if ( $this.hasClass('actions') ) {
// 							_self.rowSetActionsDefault( $row );
// 							return _self.datatable.cell( this ).data();
// 						} else {
// 							return $.trim( $this.find('input').val() );
// 						}
// 					});
// 					for (var k = 0; k < values.length; k++) send_values[k] = values[k];
// 					th_names = ["id", "title", "image", "banner_image", "rating"];
// 					var itemId = $row.attr('data-item-id');
// 					if(itemId) {
// 						$.ajax({
// 							url: 'user/updaterow',
// 							method: 'GET',
// 							data: {
// 								id: itemId,
// 								values: send_values,
// 								th_names: th_names,
// 								table: 'movies',
// 							},
// 							success: function () {}
// 						});
// 					} else {
// 						$.ajax({
// 							url: 'user/insertRow',
// 							method: 'GET',
// 							data: {
// 								values: send_values,
// 								th_names: th_names,
// 								table: 'movies'
// 							},
// 							success: function () {}
// 						});
// 					}
//
// 					_self.rowSave( $(this).closest( 'tr' ) );
// 				})
// 				.on('click', 'a.cancel-row', function( e ) {
// 					e.preventDefault();
//
// 					_self.rowCancel( $(this).closest( 'tr' ) );
// 				})
// 				.on('click', 'a.edit-row', function( e ) {
// 					e.preventDefault();
//
// 					_self.rowEdit( $(this).closest( 'tr' ) );
// 				})
// 				.on( 'click', 'a.remove-row', function( e ) {
// 					e.preventDefault();
//
// 					var $row = $(this).closest( 'tr' ),
// 						itemId = $row.attr('data-item-id');
//
// 					$.magnificPopup.open({
// 						items: {
// 							src: _self.options.dialog.wrapper,
// 							type: 'inline'
// 						},
// 						preloader: false,
// 						modal: true,
// 						callbacks: {
// 							change: function() {
// 								_self.dialog.$confirm.on( 'click', function( e ) {
// 									e.preventDefault();
//
// 							        $.ajax({
// 							            url: 'user/removerow',
// 							            method: 'GET',
// 							            data: {
// 							                id: itemId
// 							            },
// 							            success: function() {
//             								_self.rowRemove( $row );
// 							            }
// 							        });
//
// 									$.magnificPopup.close();
// 								});
// 							},
// 							close: function() {
// 								_self.dialog.$confirm.off( 'click' );
// 							}
// 						}
// 					});
// 				});
//
// 			this.$addButton.on( 'click', function(e) {
// 				e.preventDefault();
//
// 				_self.rowAdd();
// 			});
//
// 			this.dialog.$cancel.on( 'click', function( e ) {
// 				e.preventDefault();
// 				$.magnificPopup.close();
// 			});
//
// 			return this;
// 		},
//
// 		// ==========================================================================================
// 		// ROW FUNCTIONS
// 		// ==========================================================================================
// 		rowAdd: function() {
// 			// this.$addButton.attr({ 'disabled': 'disabled' });
//
// 			var actions,
// 				data,
// 				$row;
//
// 			actions = [
// 				'<a href="#" class="hidden on-editing save-row btn btn-warning" style="padding:7px 9px 7px 8px; color:white"><i class="fa fa-save"></i></a>',
// 				'<a href="#" class="hidden on-editing cancel-row btn btn-danger" style="padding:7px 8px 7px 8px; color:white"><i class="fa fa-times"></i></a>',
// 				'<a href="#" class="on-default edit-row btn btn-warning" style="padding:7px; color:white"><i class="fa fa-edit"></i></a>',
// 				'<a href="#" class="on-default remove-row btn btn-danger" style="padding:7px 8px 7px 8px; color:white"><i class="fa fa-trash"></i></a>'
// 			].join(' ');
//
// 			data = this.datatable.row.add([ '', '', '', '', '', actions ]);
// 			$row = this.datatable.row( data[0] ).nodes().to$();
//
// 			$row
// 				.addClass( 'adding' )
// 				.find( 'td:last' )
// 				.addClass( 'actions' );
//
// 			this.rowEdit( $row );
//
// 			this.datatable.order([0,'asc']).draw(); // always show fields
// 		},
//
// 		rowCancel: function( $row ) {
// 			var _self = this,
// 				$actions,
// 				i,
// 				data;
//
// 			if ( $row.hasClass('adding') ) {
// 				this.rowRemove( $row );
// 			} else {
//
// 				data = this.datatable.row( $row.get(0) ).data();
// 				this.datatable.row( $row.get(0) ).data( data );
//
// 				$actions = $row.find('td.actions');
// 				if ( $actions.get(0) ) {
// 					this.rowSetActionsDefault( $row );
// 				}
//
// 				this.datatable.draw();
// 			}
// 		},
//
// 		rowEdit: function( $row ) {
// 			var _self = this,
// 				data;
//
// 			data = this.datatable.row( $row.get(0) ).data();
//
// 			$row.children( 'td' ).each(function( i ) {
// 				var $this = $( this );
//
// 				if ( $this.hasClass('actions') ) {
// 					_self.rowSetActionsEditing( $row );
// 				} else {
// 					if(i === 0) {
// 						$this.html('<input type="text" class="form-control input-block" value="' + data[i] + '" style="width:20px; margin:0; padding:0" disabled/>');
// 					} else {
// 						$this.html('<input type="text" class="form-control input-block" value="' + data[i] + '"/>');
// 					}
// 				}
// 			});
// 		},
//
// 		rowSave: function( $row ) {
// 			var _self     = this,
// 				$actions,
// 				values    = [],
// 				th_names  = [];
//
// 			if ( $row.hasClass( 'adding' ) ) {
// 				this.$addButton.removeAttr( 'disabled' );
// 				$row.removeClass( 'adding' );
// 			}
//
// 			values = $row.find('td').map(function() {
// 				var $this = $(this);
//
// 				if ( $this.hasClass('actions') ) {
// 					_self.rowSetActionsDefault( $row );
// 					return _self.datatable.cell( this ).data();
// 				} else {
// 					return $.trim( $this.find('input').val() );
// 				}
// 			});
//
// 			this.datatable.row( $row.get(0) ).data( values );
//
// 			$actions = $row.find('td.actions');
// 			if ( $actions.get(0) ) {
// 				this.rowSetActionsDefault( $row );
// 			}
//
// 			this.datatable.draw();
// 		},
//
// 		rowRemove: function( $row ) {
// 			if ( $row.hasClass('adding') ) {
// 				this.$addButton.removeAttr( 'disabled' );
// 			}
//
// 			this.datatable.row( $row.get(0) ).remove().draw();
// 		},
//
// 		rowSetActionsEditing: function( $row ) {
// 			$row.find( '.on-editing' ).removeClass( 'hidden' );
// 			$row.find( '.on-default' ).addClass( 'hidden' );
// 		},
//
// 		rowSetActionsDefault: function( $row ) {
// 			$row.find( '.on-editing' ).addClass( 'hidden' );
// 			$row.find( '.on-default' ).removeClass( 'hidden' );
// 		}
//
// 	};
//
//
//
// 	$(function() {
// 		example1.initialize();
// 		// TeacherQuizTable.initialize();
// 	});
//
// }).apply(this, [jQuery]);
