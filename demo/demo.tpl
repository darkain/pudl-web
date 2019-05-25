<style>
#af-sidebar-parent {
	background: linear-gradient(to bottom, rgb(58,58,165) 0%,rgb(165,58,111) 100%);
}

#af-sidebar-list div.af-sidebar-open:nth-child(even) {
	background:rgba(255,0,255,0.15);
}

#af-sidebar-list div.af-sidebar-open:nth-child(odd) {
	background:rgba(0,0,255,0.15);
}

#af-sidebar-body {
	color:#fff;
	background:linear-gradient(135deg, rgb(58,58,165) 0%,rgb(165,58,111) 100%);
}
</style>

<script>
var history_ready		= false;
var history_block		= false;
var history_location	= document.location.toString();

$(function(){
	History.Adapter.bind(window, 'statechange', function() {
		if (history_block) return;
		af_sidebar_ajax(null, History.getState().cleanUrl, false, true);
	});

	af_sidebar_init('[afurl.host]');
});
</script>


<div id="af-sidebar-parent">
	<div id="af-sidebar-list">
		[sidebar;safe=no]
	</div>
</div>


<div id="af-sidebar-body">
	<div id="af-sidebar-page">
		<div class="center largest">
			<br/><br/><br/><br/>
			Select an item from the menu on the left
		</div>
	</div>
</div>
