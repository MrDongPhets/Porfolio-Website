


// reviews carousel - dynamic data
function renderReviews(idx){
    const container = $('#carousel').empty();
    
    if (reviews.length === 0) {
    container.html('<p style="text-align:center;color:var(--muted)">No testimonials yet.</p>');
    return;
    }
    
    const per = $(window).width() > 900 ? 2 : 1;
    for(let i=0;i<per;i++){
    const r = reviews[(idx+i) % reviews.length];
    const initials = r.client_name.split(' ').map(s=>s[0]).slice(0,2).join('');
    const stars = '★'.repeat(r.rating);
    
    const card = $(
        `<div class="review-card ${i===0?'active':''}">
        <div class="review-meta">
            <div class="avatar">${initials}</div>
            <div>
            <div class="name">${r.client_name}</div>
            <div class="stars">${stars}</div>
            </div>
        </div>
        <p style="color:var(--muted);margin-top:12px">${r.testimonial}</p>
        </div>`
    );
    container.append(card);
    }
}

let index = 0;
renderReviews(index);
$('#next').on('click', function(){ 
    if(reviews.length > 0) {
    index=(index+1)%reviews.length; 
    renderReviews(index); 
    }
});
$('#prev').on('click', function(){ 
    if(reviews.length > 0) {
    index=(index-1+reviews.length)%reviews.length; 
    renderReviews(index); 
    }
});

// contact form - save to database
$('#contactForm').on('submit', function(e){
    e.preventDefault();
    const name = $('#name').val();
    const email = $('#email').val();
    const message = $('#message').val();
    const submitBtn = $(this).find('button[type="submit"]');
    
    submitBtn.text('Sending...').prop('disabled', true);
    
    // Send to contact handler
    $.ajax({
    url: '<?php echo baseUrl("contact-handler.php"); ?>',
    method: 'POST',
    data: { name, email, message },
    success: function(response) {
        alert('Message sent — thank you, ' + name + '!');
        $('#contactForm')[0].reset();
    },
    error: function(xhr, status, error) {
        console.error('Contact form error:', error);
        alert('Failed to send message. Please try again or email directly.');
    },
    complete: function() {
        submitBtn.text('Send Message').prop('disabled', false);
    }
    });
});

// CTA button click
$('#cta').on('click', function(){
    $('html, body').animate({
    scrollTop: $('#contact').offset().top - 80
    }, 600);
});

// animation on scroll
$(window).on('scroll resize', function(){
    $('.review-card').each(function(i,el){
    const r = $(el).offset().top - $(window).scrollTop();
    if(r < $(window).height()*0.85) $(el).css('transform','translateY(0)');
    });
});
