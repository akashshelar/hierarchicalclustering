function Deactivate_account(mail)
{
	if(confirm('Are you sure to deactivate your account ?') == true)
	{
		$.ajax({
			url : "deactivate.php?email="+mail,
			type: 'GET',
			success : function(data)
			{
				//alert(data);
				window.location.href = 'index.php?msg=7';	
			},
			error : function(data)
			{
				console.log()
			}
		});
	}
}