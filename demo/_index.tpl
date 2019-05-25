<html>
<head>

<title>PUDL Web Client</title>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<style>
nav {
	position:fixed;
	top:0;
	left:0;
	width:200px;
	height:100%;

	background: linear-gradient(to bottom, rgb(58,58,165) 0%,rgb(165,58,111) 100%);
	color:#fff;
	/*text-shadow:0 0 0.2em #000;*/
	animation: shadow-change 10s infinite;
}

nav ul {
	padding:0.2em;
	margin:0;
}

nav ul li {
	list-style:none;
	padding:0.33em 0.75em;
	margin:0;
	animation: color-change 10s infinite;
}

nav ul li:before {
	content:"";
	background:url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 31.444 31.444"><path fill="white" d="M1.119,16.841c-0.619,0-1.111-0.508-1.111-1.127c0-0.619,0.492-1.111,1.111-1.111h13.475V1.127C14.595,0.508,15.103,0,15.722,0c0.619,0,1.111,0.508,1.111,1.127v13.476h13.475c0.619,0,1.127,0.492,1.127,1.111c0,0.619-0.508,1.127-1.127,1.127H16.833v13.476c0,0.619-0.492,1.127-1.111,1.127c-0.619,0-1.127-0.508-1.127-1.127V16.841H1.119z"/></svg>');
	display:inline-block;
	width:0.7em;
	height:0.7em;
	margin-right:0.2em;
	vertical-align:middle;
	filter: drop-shadow(0 0 0.2em #000);
}

nav ul li:hover {
	background:linear-gradient(to bottom, rgba(242,246,248,0.5) 0%,rgba(216,225,231,0.5) 50%,rgba(181,198,208,0.5) 51%,rgba(224,239,249,0.5) 100%);
	border-radius:1em;
	cursor:pointer;
}

main {
	position: fixed;
	top:0;
	left:200px;
	width:calc(100% - 232px);
	height:calc(100% - 32px);

	overflow:auto;

	padding:1em;

	background:linear-gradient(to right, rgb(58,58,165) 0%,rgb(165,58,111) 100%);
	color:#fff;
}
</style>
</head>

<body>
	<nav>
		<ul>
			<li data-path="/table/[table.name;safe=url]">
				[table.name;block=li]
			</li>
		</ul>
	</nav>
	<main>
		moar stuff
	</main>
</body>

<script>
$(function(){
	$('li').click(function(){
		$('main').load( $(this).data('path') );
	});
});
</script>
</html>

