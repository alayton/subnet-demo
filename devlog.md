## Initial Impressions and Planning

Coming into the challenge, I wasn't sure what to expect. Given the week timeline, I was a bit afraid it was going to be somewhat involved, and was bracing myself for it. While speaking with Randy, I had said that with getting up to speed with Symfony and Angular, I expected to need the full week. Once I was able to look over the requirements, I was pleasantly surprised - the task looked simple enough that it even with learning on the fly, it should only take a few days. I didn't think it was going to neccessitate any questions, so I thought it would be a good idea to write this to take the place of that lack of communication.

With requirements in hand, a plan for how to approach the task quickly started coming together. A three day plan seemed doable, and was pretty straightforward to break down.
 
 * Day 1: Environment setup. Get a full skeleton up and running in Docker
 * Day 2: Implement Symfony backend
 * Day 3: Implement Angular frontend

## Day 1

The first thing I did was hit Google and see what sort of containers were out there to use as a starting point. The very first result was the repo this was forked from, using docker-compose for a Symfony/MySQL/Angular stack - a very close fit. It's my first time working with docker-compose, which has turned out to be quite nice, so definitely some useful experience.

With a base found, step one was to audit it and rip out the extra containers I didn't need. I also updated the images with a preference for alpine to minimize container size. This part of the process was basically a crash course on Docker, and I got things updated pretty quickly. With the amount I changed, I don't think I'd recommend the original repo to someone else, but it served its purpose well enough for my needs.

At this point, I had the basics of the containers roughed out, and it was time to get things actually running. For a clean slate to start from, I got rid of the Symfony instance that was included and used Composer to generate a new one. Next, I used the console tools to create some basic entities for the data model, and attempted to create a migration from them. This is where it went downhill.

Instead of a migration being created, I got an error about Doctrine not finding a driver. This sparked hours of googling and trying different things with the Dockerfile to try and make sure the driver was installed and enabled. I was baffled, because when I would run `php -m` in the container, it would be there, but when I would try the migration again, nothing would change. I checked for a separate CLI php.ini, but the image only seems to have one.

Finally, I looked again at how I was creating the migration, and facepalmed, hard. I wasn't running it inside the container, so it was looking for the driver in my local PHP install, which I wasn't touching. Once I tried running it in the right place, a driver was found, and a new error was thrown. Apparently `localhost` isn't appreciated in the database URL, so after a change to 127.0.0.1, and then to the MySQL container hostname, I finally had a migration created.

At this point, I'm actually at the start of Day 2, but I'm keeping things organized according to the plan. I finished up the entities, ran the migrations, and had a functioning Symfony container - now onto Angular. The base repo included Angular 6 and wouldn't build successfully, so just like Symfony, I got rid of it and generated an empty Angular 9 project with the CLI. With a bit more tweaking of the docker-compose config, I had Angular up and running too, and the environment was ready.

## Day 2

I already had entities created as part of getting the MySQL schema in place, so the first thing code I wrote was a command for inserting the demo JSON. This was pretty simple, with the biggest roadblock being needing to persist subnets and IP addresses separately. The error message from that mentioned being able to cascade persists, but I didn't spend much time trying to do that, and just went to doing it myself. Eventually, this command will need to be run as part of the `docker-compose up`, but I'm saving that for the end when I'm packaging it up and verifying things work from scratch.

All that was left, already, was just the controller. When I was last working with PHP extensively, I would never use the code generation tools, prefering to just create my controllers and entities by hand. Now.. I generated a new controller. The code needed for the single endpoint is even more simple than the command. Getting the entities out of the repository was dirt simple, leaving serialization the only real hurdle.

`FOSRestBundle` seems like the go-to solution for REST API's, but it doesn't support Symfony 5 yet, so that wasn't an option. `JMSSerializer` was referenced alongside it repeatedly, and seems to work fine. After adding that in and implementing it, the backend was done, even faster than I expected. With the extra time, I got started on writing this.

## Day 3

This is the part that I expected to be the most challenging, and I wasn't wrong. Angular uses a lot of conventions that are radically different from React, and some of the syntax is just completely foreign. That said, I've always learned by diving in and finding answers as I go, and that's what I did this time as well. Typically, that means working from existing code and adopting practices from that. In this case, I'm not working with an existing codebase, so the introductory Angular tutorial (among others that I found for specific problems) served that purpose.

The result is, I suspect, a very basic app structure that probably wouldn't scale very well. That's definitely something that was on my mind throughout the day: how should I be approaching this? Writing the app to simply meet the requirements, or spending time on a more robust structure to try to show more mastery?

I've obviously chosen the former, in part because I don't have much mastery to show in this area, but also because I'm a firm believer in not overengineering a solution. In order to plan for a more robust application, some idea of what it could be down the road is needed - that's definitely not something I have here, so I feel pretty okay about this choice.

While Angular is very different from React, I've found that I quite like the tooling around it. One of the big headaches in starting a React project is getting a good build pipeline put together, and all of that is just baked into Angular's CLI for free. I love it.

I've kind of gone off on a couple tangents today, but that kind of says something about how the work went. There wasn't anything that came up as a serious roadblock, and once I started getting a grasp of how Angular works, the parts just sort of fell into place. There are parts that I'm not certain about (namely, the massaging of the endpoint response in the subnet service), but I don't feel bad about them either.

## Final Thoughts

I'm happy with how much I've learned through this challenge, particularly with Docker and Angular. I'm concerned with my interpretation of the challenge though, because it seems like something that could be easily done in under a day by someone with recent Symfony and Angular experience. Maybe the week timeline is intended for people only spending a couple hours in the evenings?

I knew I would probably enjoy Angular once I gave it a chance - the same friends that originally sold me on Go have been using it for years now. I'm a bit relieved that working with PHP is better than I remembered. It's probably unfair to base my opinion of it on the When I Work codebase. That monstrosity is Symfony in the same repository as Kohana, built on questionable 10 year old code.