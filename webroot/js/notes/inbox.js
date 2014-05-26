$(document).ready(function() {
	$('.markRead').click(function() {
            var _this = this;
            var note_id = $(_this).attr('note_id');
            $.post("/notes/markRead/" + note_id, function() {
                $(_this).remove();
            });
	});

	var handled = true;
	var paused = false;
	
	$("#NoteContent").focusin(function() {
		paused = true;
	});

	$("#NoteContent").focusout(function() {
		paused = false;
	});

	$(document).everyTime(1000 * 90, 'check', function() {
		if (handled && !paused) {
			$.getJSON("/notes/checkNew", function(count) {
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
				}
			});
		} // end handled
	});
});
