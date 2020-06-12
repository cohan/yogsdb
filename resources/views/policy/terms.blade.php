@extends('ydb.master')

@section('content')
<div class="col-sm-9 post_page_uploads">
    <div class="row">

        <article class='policy'>

            <h1 class="post-title">Terms</h1>

            <div class="post-content">
                <p>The Yogs DB API is a REST API that allows access to all of the data we’ve gathered/created.</p>
                <p>In this document any references to “Yogscast” or “The Yogscast” refers to Yogscast Ltd and associated channels and companies.</p>
                <h2 id="terms-of-use">Terms of Use</h2>

                <h3>YouTube</h3>

                <p>Please adhear to the <a href='https://www.youtube.com/t/terms'>YouTube Terms of Service</a> in addition to the YogsDB Terms of Service that follow.</p>

                <h3 id="not-yogscast">Not Yogscast</h3>
                <p>This is not a Yogscast endorsed, affiliated, paid or sponsored project in any way. I’m not working on behalf of The Yogscast nor do I claim to be doing so. If you have any issues with the site or API <a href="https://cohanrobinson.com/contact">contact me</a>, please don’t bug them in regards to this site.</p>
                <h3 id="non-commercial-use">Non-commercial use</h3>
                <p>If you use data from this site you cannot use it for commercial purposes. The reasoning behind this is that it takes a lot of time and effort to gather up the data provided by the site, if you want to make bank - you do the work! Also it’s because it’s a fan project and the general rule with Yogscast fan projects is that they must be non-commercial. You should also be following those guidelines too.</p>
                <h3 id="credit-the-data">Credit the data</h3>
                <p>If you use data from this site please mention somewhere where you got the information. This doesn’t need to be anything fancy, a comment in your page’s HTML source wherever the data is used will do nicely. Basically just provide some way for other devs to find out where they can get at the data too.</p>
                <h3 id="excessive-requests">Excessive requests</h3>
                <p>There’s no rate limiting as such at this time but please before you loop through every video ID on the site make sure there’s no better way to do it beforehand. If you’re unsure on whether you’re creating excessive requests consider your code - are you making a new query per object inside a loop? That may be excessive. <a href="https://cohanrobinson.com/contact">Get in touch</a> if the API doesn’t return all the results you need!</p>
                <p>Feel free to use the API in a frontend manner, i.e. loading in data via AJAX calls. CORS headers have been added to the api.yogsdb.com domain to allow this.</p>
                <h3 id="competitiveness">Competitiveness</h3>
                <p>Please don’t just take the data to build your own database of information. If you’d like more data to be included please do <a href="https://cohanrobinson.com/contact">get in touch</a> and let me know what else the site can provide. The site uses Laravel PHP for the backend if you’re interested in helping code up some stuff.</p>
                <p>In turn, let me know of any particularly unique ways you’re using the data provided on the site and I’ll do my best to avoid competing back.</p>
                <h3 id="permissions-i-cannot-give">Permissions I cannot give</h3>
                <p>I cannot give permission to do anything in terms of Yogscast copyright, trademarks or licensing. It’s simply not mine to give. If you’re looking to reuse actual content (e.g. video clips, audio, etc) you’ll need to contact The Yogscast directly.</p>
                <h3 id="access-to-the-data">Access to the data</h3>
                <p>Mainly just to cover my back here, I can refuse your access to the Yogs DB site and/or data at any time for any reason and without any notice. This is unlikely to happen, but I have to reserve that right.</p>
                <p>Unlikely as it is I also reserve the right to shut the site down without any notice or reason. I’ll do my best to let everyone know in advance if that is ever the case.</p>
                <h3 id="changes">Changes</h3>
                <p>These terms can be changed at any time for any reason. Please either check back frequently or subscribe to updates for this page.</p>

            </div>

        </article>

    </div>
</div>
@endsection