var searchBuff = {};
	searchBuff.counter = 0;
	searchBuff.interval;
	searchBuff.url;
	searchBuff.preload = function(){};
	searchBuff.postload = function(){};
	searchBuff.data;
	searchBuff.error = function(e){
		console.log(e);
	}
	searchBuff.success = function(data){
	};
	searchBuff.start = function(){
		searchBuff.counter = 14;
		if(searchBuff.interval==null){
			searchBuff.preload();
			searchBuff.interval = setInterval(function(){
				if(searchBuff.counter>0){
					searchBuff.counter--;
				}
				else{
					searchBuff.postload();
					clearInterval(searchBuff.interval);
					searchBuff.interval = null;
					searchBuff.request();
				}
			},10);
		}
	}
	searchBuff.request = function(sendData){
		searchBuff.preload();
		$.ajax({
			url: searchBuff.url,
			method: 'post',
			data: searchBuff.data,
			success: searchBuff.success,
			error: searchBuff.error
		})	
	}