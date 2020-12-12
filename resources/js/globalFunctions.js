/********************************************************
	custom global functions
********************************************************/

// notify
window.notify = function(text){
	toastify({
		text: text,
		duration: 2000,
		close: true,
		gravity: "top", // `top` or `bottom`
		position: 'right', // `left`, `center` or `right`
		backgroundColor: "#a0a0a0",
		color: "#202020",
		stopOnFocus: true, // Prevents dismissing of toast on hover
		className: "bg-success",
	}).showToast();
}

// set loading spinner (showLoading, hideLoading)

// SpinnerOptions
var SpinnerOptions = {
	lines: 12, // The number of lines to draw
	length: 2, // The length of each line
	width: 12, // The line thickness
	radius: 76, // The radius of the inner circle
	scale: 0.9, // Scales overall size of the spinner
	corners: 1, // Corner roundness (0..1)
	color: '#434343', // CSS color or array of colors
	fadeColor: 'transparent', // CSS color or array of colors
	speed: 1.1, // Rounds per second
	rotate: 0, // The rotation offset
	animation: 'spinner-line-fade-default', // The CSS animation name for the lines
	direction: 1, // 1: clockwise, -1: counterclockwise
	zIndex: 2e9, // The z-index (defaults to 2000000000)
	className: 'spinjs-spinner', // The CSS class to assign to the spinner (spinner class conflicts with theme-app-css (simulor) (same class name))
	top: '50%', // Top position relative to parent
	left: '50%', // Left position relative to parent
	shadow: '0 0 4px 1px #909090', // Box-shadow for the lines
	position: 'absolute' // Element positioning
};

// create spinner
var spinner = new Spinner(SpinnerOptions);

// create parent
var spinnerParent = document.createElement("div");
spinnerParent.style.padding = "0";
spinnerParent.style.margin = "0";
spinnerParent.style.position = "fixed";
spinnerParent.style.top = "0";
spinnerParent.style.bottom = "0";
spinnerParent.style.left = "0";
spinnerParent.style.right = "0";
spinnerParent.style.zIndex = "9999";
spinnerParent.style.backgroundColor = "rgba(80, 80, 80, 0.2)";
spinnerParent.style.cursor = "default";
spinnerParent.oncontextmenu = function(e){
	e.preventDefault();
}

spinnerParent.onselectstart = function(){
	return false;
}


// show loading
window.showLoading = function(){
	document.body.appendChild(spinnerParent);
	spinner.spin(spinnerParent);
};


// hide loading
window.hideLoading = function(){
	if(spinnerParent.parentNode){
		spinnerParent.parentNode.removeChild(spinnerParent);
	}
	spinner.stop();
}

/****************************
	alert
****************************/
window.Alert = function(message, onTrueValue = null, onNullValue = null){
	var message = message;
	//var onTrueValue = onTrueValue || function(){};
	//var onNullValue = onNullValue || function(){};

	if(onTrueValue == null){
		swal.fire({
			title: message,
			icon: "warning",
		})
	}else{
		swal.fire({
			title: message,
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then(function(value){
			if(value == true){
				onTrueValue();
			}else{
				if(onNullValue != null){
					onNullValue();
				}
			}
		})
	}
}

window.Confirm = function(message, onTrueValue = null, onNullValue = null){
	var onTrueValue = onTrueValue || function(){};
	var onNullValue = onNullValue || function(){};

	swal.fire({
		title: message,
		icon: "",
		buttons: true,
		dangerMode: false,
	})
	.then(function(value){
		if(value == true){
			onTrueValue();
		}else{
			onNullValue();
		}
	})
}

/****************************
	success
****************************/
window.Success = function(message, onThen){
	var message = message;
	var onThen = onThen || function(){};

	swal.fire(message, "", "success")
	.then(function(value){
		onThen(value);
	})
}

/****************************
	info
****************************/
window.Info = function(message){
	swal.fire({
		title: message,
		icon: "info",
		buttons: true,
		dangerMode: false,
	})
	.then(function(value){
		if(value == true){
			onTrueValue();
		}else{
			onNullValue();
		}
	})
}

/****************************
	error
****************************/
window.Error = function(message){
	swal.fire(message, "", "error");
}
