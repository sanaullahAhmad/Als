<script>
var UITree = function () {
var ajaxTreeSample = function() {
	$("#tree_4").jstree({

	"core" : {

		"themes" : {

			"responsive": false

		}, 

		// so that create works

		"check_callback" : true,

		'data' : {

			'url' : function (node) {

			  return '<?php echo base_url();?>home/jstree_ajax_data';

			},

			'data' : function (node) {

			  return { 'parent' : node.id };

			}

		}

	},

	"types" : {

		"default" : {

			"icon" : "fa fa-folder icon-state-warning icon-lg"

		},

		"file" : {

			"icon" : "fa fa-file icon-state-warning icon-lg"

		}

	},

	"state" : { "key" : "demo3" },

	"plugins" : [ "dnd", "state", "types" ]

	});
}
return {
		//main function to initiate the module
		init: function () {
			ajaxTreeSample();
		}
	};
}();
if (App.isAngularJsApp() === false) {
	jQuery(document).ready(function() {    
	   UITree.init();
	});
}
$('#tree_4').on("changed.jstree", function (e, data) {

    // open a new window with your url
	$(".final_node_icon").each(function(){
        var ancor = $(this).parent().attr('id');
		var res = ancor.split("node_final_");
		var res2 = res[1].split("_anchor");
		$(this).parent().attr("onclick", "single_management_post('<?php echo base_url();?>single_management_post/"+res2[0]+"')");
    });
   // window.open("http://www.google.com/");
	//console.log(e);

    // call a function
    //myFunction();

})
function single_management_post(url)
{
	 window.open(url);
}
</script>