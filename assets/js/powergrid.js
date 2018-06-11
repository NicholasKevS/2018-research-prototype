function removeBadge() {
	$("#notifBadge1").remove();
	$("#notifBadge2").remove();
	$.ajax({ url: 'notification/read/'});
}