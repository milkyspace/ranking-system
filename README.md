# Ranking System
A system for calculating the rank using ranking criteria
- we can count any ratings and with any criteria <br>
- we can separate the ranking calculation for different languages <br>
- clear division into types for ranking <br>
- ranking = ranking of the first type + ranking of the second type + ... <br>
- each of the criteria "weighs" a certain number of points <br>

There are two ratings:<br>
- the first rating<br>
- rating second<br>
The overall rating is calculated as the arithmetic mean of composite ratings.<br>
0% is the minimum rating.<br>
The rating cannot be negative.<br>
100% is the maximum rating.<br>

Starting the recalculation:<br>
Ranking\Cron\RankingUpdate::execute([#elementID#,], true);<br>

You can pass the id of the required elements to the parameter [#elementID#,]. <br>
After the calculation, the log will be displayed. <br>
The results will be in “rank". <br>
Next, a log will be displayed in which you can see the calculated points for each of the criteria. <br>
