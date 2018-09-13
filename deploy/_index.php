<?php



////////////////////////////////////////////////////////////////////////////////
//VERIFY WE HAVE A SECRET SET
////////////////////////////////////////////////////////////////////////////////
assert500(
	!empty($af->config->github['secret']),
	'No GitHub secret has been defined - $afconfig["github"]["secret"]'
);




////////////////////////////////////////////////////////////////////////////////
//VERIFY WE HAVE A BRANCH SELECTED
////////////////////////////////////////////////////////////////////////////////
assert500(
	!empty($af->config->github['branch']),
	'No GitHub branch has been defined - $afconfig["github"]["branch"]'
);




////////////////////////////////////////////////////////////////////////////////
//VERIFY WE HAVE A LOCAL PATH SELECTED
////////////////////////////////////////////////////////////////////////////////
assert500(
	!empty($af->config->github['path']),
	'No local git repository path specified - $afconfig["github"]["path"]'
);




////////////////////////////////////////////////////////////////////////////////
//PULL THE GITHUB SIGNATURE FOR THIS REQUEST
////////////////////////////////////////////////////////////////////////////////
list($algo, $hash)	= explode('=', $get->server('HTTP_X_HUB_SIGNATURE'), 2)
					+ ['', ''];




////////////////////////////////////////////////////////////////////////////////
//VERIFY WE CAN TEST THIS PARTICULAR ALGO
////////////////////////////////////////////////////////////////////////////////
assert500(
	in_array($algo, hash_algos(), true),
	'Algorithm not supported: ' . $algo
);




////////////////////////////////////////////////////////////////////////////////
//VERIFY MINIMUM HASH COMPLEXITY
////////////////////////////////////////////////////////////////////////////////
if (!empty($af->config->github['strength'])) {
	assert500(
		strlen(hash($algo, '')) * 4  >=  $af->config->github['strength'],
		'Hash Algorithm does not meet minimum security strength requirements'
	);
}




////////////////////////////////////////////////////////////////////////////////
//VERIFY HASH
////////////////////////////////////////////////////////////////////////////////
assert422(
	hash_equals(hash_hmac($algo, $get(), $af->config->github['secret']), $hash),
	'Input security validation failed'
);




////////////////////////////////////////////////////////////////////////////////
//THIS ISN'T OUR LIVE BRANCH, SO WE IGNORE IT
////////////////////////////////////////////////////////////////////////////////
if ($get('ref') !== 'refs/heads/'.$af->config->github['branch']) {
	echo "Not our branch, so we are ignoring it:\n" . $get('ref');
	return;
}




////////////////////////////////////////////////////////////////////////////////
//SINGLE INSTANCE - PULL THE LATEST CODE FROM GIT AND COMPILE ASSETS
////////////////////////////////////////////////////////////////////////////////
if (empty($afconfig->instances)) {
	require('deploy.inc.php');
	require('assets.inc.php');




////////////////////////////////////////////////////////////////////////////////
//MULTI INSTANCE - TELL EACH SERVER TO PULL LATEST CODE
////////////////////////////////////////////////////////////////////////////////
} else {
	$algo			= !empty($af->config->github['hash'])
						? $af->config->github['hash']
						: 'sha1';

	foreach ($afconfig->instances as $instance) {
		$url		= 'https://' . $instance . '/deploy/pull';
		$token		= afstring::password(32);
		$message	= implode('-', [$af->time(), $token]);

		$data		= $afurl->post($url, [
			'hash'	=> hash_hmac($algo, $message, $afconfig->afkey()),
			'time'	=> $af->time(),
			'algo'	=> $algo,
			'token'	=> $token,
		]);

		echo $url . "\n\n" . $data['content'] . "\n\n\n";
	}
}




////////////////////////////////////////////////////////////////////////////////
//DONE!!
////////////////////////////////////////////////////////////////////////////////
echo 'DONE!';
