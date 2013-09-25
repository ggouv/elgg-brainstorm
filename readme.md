# Elgg brainstorm

This plugin offer ability to feedback/brainstorm members of groups. I am inspired from [http://uservoice.com/feedback]()

## Rules
Members can easily submit and discuss ideas, and vote from 1 to 3 about them.  
Each member start with 10 points (by default, group admin can change this value). When it reach zero, he cannot vote. This system prevents fraud and vocal minorities.

Members get back points when an idea is accepted (or declined) by group owner.  
This make sure people focus on the ideas they care most about.

When user submit idea, live search makes sure that members find similar feedback to vote for rather than create a new (duplicate) entry.

###It's a very good system to create a dynamic and fun system for brainstorm and feedback on your group.

## Features

- Live search on idea and highlight result.
- Submit idea get title from the search form.
- Top, hot list idea order by ascendent or descendant.
- All ajaxified votes
- Group owner can :
  - set status of idea to under review, planed, started, accepted and declined by default or choose label of this status
  - choose to merge tabs of idea's status in brainstorm view
  - choose if a member can submit idea without point
  - set the description and question of the brainstorm

## Next step

- Offer group administrator to custom number of started points
- Offer group administrator to merge ideas
- Categories ideas for each group
- Show idea stats with highcharts.js
- Connect with a task manager ?
- Set a ticket system like [http://uservoice.com/helpdesk](http://uservoice.com/helpdesk) ???

## Compatibility

River items are avaible in json : works fine with [https://github.com/ggouv/elgg-deck_river](https://github.com/ggouv/elgg-deck_river)

## Licence

Dual licensed under the MIT and GNU Affero General Public License, version 3 or late
@copyright (c) Emmanuel Salomon 2012

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell