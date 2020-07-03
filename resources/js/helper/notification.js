class Notification {
    success(){
        new Noty({
            type: 'success',
            layout: 'topRight',
            text: 'Successfully done !',
            timeout:1000,
        }).show();
    }
}
export default Notification = new Notification();
