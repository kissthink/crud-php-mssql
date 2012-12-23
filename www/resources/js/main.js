function updateNavBar(section) {
	$('.nav li').removeClass('active');
	$('.nav li[data-ref="'+ section + '"]').addClass('active');
}