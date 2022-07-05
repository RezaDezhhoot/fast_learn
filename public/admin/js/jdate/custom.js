const formController = document.querySelector('.form-controller');
var doc = document.documentElement;
var top = (window.pageYOffset || doc.scrollTop) - (doc.clientTop || 0);

if (doc.scrollTop > 15 && window.innerWidth > 768) {
    formController.style = 'top:0';
} else {
    formController.style = '';
}

if (formController)
{
    document.addEventListener('scroll', function() {
        var doc = document.documentElement;
        var top = (window.pageYOffset || doc.scrollTop) - (doc.clientTop || 0);
        if (top > 15 && innerWidth > 768) {
            formController.style = 'top:0';
        } else {
            formController.style = '';
        }
    });
}
