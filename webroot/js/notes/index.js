$(document).ready(function() {
	$('.reply').click(function() {
		var row = $(this).parent().parent();
		var name = row.find('.creator').html();
		$('textarea').val('To ' + name + ' : ');
	});

	var paused = false;

	$("#NoteContent").focusin(function() {
		paused = true;
	});

	$("#NoteContent").focusout(function() {
		paused = false;
	});

	$(document).everyTime(1000 * 90, 'check', function() {
		if (!paused) {
			$.getJSON("/notes/checkNew", function(count) {
				var has = '';
				if (count > 0) {
					handled = false;
	
					var msg = "有" + count + "个新私信！";
	
					var title = msg;
					$(document).everyTime(400, 'title', function() {
						title = title.substring(1, title.length) + title.substring(0, 1);
						document.title = title;
					});
	
					$("#alertDialog").find("p").html(msg).end().dialog({
						modal: false, buttons : {
							"确定": function() {
								handled = true;
								$(document).stopTime("title");
								document.title = "管师傅 - 管理中心";
								location = location;
	
								$( this ).dialog( "close" );
							},
							"取消" : function() {
								handled = true;
								$(document).stopTime("title");
								document.title = "管师傅 - 管理中心";
	
								$( this ).dialog( "close" );	            			
							}
						}
					});
				} // end count
				else {
					location = location;
				}
			}); // end get json
		} // end if paused
		});
});
