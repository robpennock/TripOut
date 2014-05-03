$( document ).ready(function() {
    alert('test');
    $('#content').load('Views/home.php');
    
    $('#logo').on("click", function(){
        $('div li').removeClass('active')
        $( "li[name='home']" ).toggleClass('active');
        $('#mainContent').load('Views/home.php');
    });
    
    /*
    $('#homeLink').on("click", function(){
        $('div li').removeClass('active')
        $( "li[name='home']" ).toggleClass('active');
        $('#mainContent').load('Views/home.php');
    });*/
    
    $('#writeReviewLink').on("click", function(){
        $('div li').removeClass('active')
        $( "li[name='writeReview']" ).toggleClass('active');
        $('#mainContent').load('Views/reviewSearch.php');
    });
    
    /*
    $('#createDestinationLink').on("click", function(){
        $('div li').removeClass('active')
        $( "li[name='createDestination']" ).toggleClass('active');
        $('#mainContent').load('Views/createDestination.php');
    });
    */
   /*
    $('#aboutLink').on("click", function(){
        $('div li').removeClass('active')
        $( "li[name='about']" ).toggleClass('active');
        $('#mainContent').load('Views/about.html');
    });*/
       
    $('#signInButton').on("click", function(){
        $('div li').removeClass('active')
        $('#mainContent').load('Views/signIn.php');
    });
    
    $('#registerButton').on("click", function(){
        $('div li').removeClass('active')
        $('#mainContent').load('Views/signUp.php');
    });
});