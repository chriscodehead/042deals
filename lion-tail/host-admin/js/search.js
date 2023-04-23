// JavaScript Document
$('#search').keyup(function()
{
	var searchterm = $('#search').val();
	if(searchterm != '')
	{
		$.post('search-participant.php', {searchterm: searchterm},
		function(data)
		{
			$('#searchresults').html(data);
			});
		}
		else {
			$('#searchresults').html('');
			}
	});
	
