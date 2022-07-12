/* Default Notifications */
function default_noti() {
	Lobibox.notify('default', {
		pauseDelayOnHover: true,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function info_noti() {
	Lobibox.notify('info', {
		pauseDelayOnHover: true,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		icon: 'bx bx-info-circle',
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function warning_noti() {
	Lobibox.notify('warning', {
		pauseDelayOnHover: true,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		icon: 'bx bx-error',
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function error_noti() {
	Lobibox.notify('error', {
		pauseDelayOnHover: true,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		icon: 'bx bx-x-circle',
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function success_noti() {
	Lobibox.notify('success', {
		pauseDelayOnHover: true,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		icon: 'bx bx-check-circle',
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}
/* Rounded corners Notifications */
function round_default_noti() {
	Lobibox.notify('default', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		delayIndicator: false,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function round_info_noti() {
	Lobibox.notify('info', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		icon: 'bx bx-info-circle',
		delayIndicator: false,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function round_warning_noti() {
	Lobibox.notify('warning', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		delayIndicator: false,
		icon: 'bx bx-error',
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function round_error_noti(id) {
	Lobibox.notify('error', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		delayIndicator: false,
		icon: 'bx bx-x-circle',
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: id
	});
}

function round_success_noti() {
	Lobibox.notify('success', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		icon: 'bx bx-check-circle',
		delayIndicator: false,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: 'Sukses menyimpan data'
	});
}
