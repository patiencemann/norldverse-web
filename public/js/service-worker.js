self.addEventListener('notificationclick', function(event) {
    event.notification.close();

    // Perform an action based on the button clicked
    if (event.action === 'customAction') {
        // Handle the custom action here
        // You can open a new URL or perform any desired action
        clients.openWindow('/new-page.html');
    }
});
