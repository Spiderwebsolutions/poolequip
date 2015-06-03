<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

    <div class="container" id="contact">
        <div class="content">
            <div class="content-half">
                <h2>Contact Us</h2>
                <a href="tel:+61892487946"><span class="icon-phone"></span>08 9248 7946</a>
                <p><span class="icon-location"></span><a href="https://www.google.com.au/maps/place/Poolequip/@-31.855851,115.892733,15z/data=!4m2!3m1!1s0x0:0x78f60a21f7bc310c?sa=X&ei=CrZdVd2aBoX38QXWrYHgAg&ved=0CHoQ_BIwCw" target="_blank">Unit 4, 1968 Beach Road, Malaga, WA, 6090</a></p>
                <p><span class="icon-mail"></span><a href="mail:sales@poolequip.com.au">sales@poolequip.com.au</a></p>
                <p><span class="icon-clock"></span>Opening Hours</p>
                <ul>
                    <li>Mon - Fri: 9am - 5pm</li>
                    <li>Saturday:  9am - 1pm</li>
                </ul>

                <form abineguid="8018C6F82C1244AA8F736B7EDE851667">
                    <input type="text" placeholder="Your Name" id="name">
                    <input type="text" placeholder="Your Email Address*" id="email">
                    <textarea rows="3" placeholder="Message*"></textarea>
                    <button type="submit" value="Submit">SUBMIT</button>
                </form>
            </div>
            <div class="content-half">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d54207.61302952547!2d115.88746514492665!3d-31.88007431262663!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2a32b1bce54996e5%3A0x78f60a21f7bc310c!2sPoolequip!5e0!3m2!1sen!2sau!4v1431765524235" width="100%" height="435" frameborder="0" style="border:0"></iframe>
            </div>
        </div>
    </div>

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
