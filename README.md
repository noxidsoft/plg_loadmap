# plg_loadmap
This Google Map extension built for Joomla will allow you to add a quick clickable map icon or hyperlink into a Joomla article using a land address already included in content.

No coordinates or fancy configuration needed and it should work on any address in the world (where Google supports this) when making use of the easy plugin parameters.

###Usage:###
Standard text...

~~~
Coles Express Highfields (Shell)
10526 New England Hwy, Highfields
Ph 07 30 8282
~~~

Once the plugin is installed and enabled, you add...

~~~
Coles Express Highfields (Shell)
{loadmap 10526 New England Hwy, Highfields}
Ph 07 30 8282
~~~

You should now have a map link next to your address that will redirect to Google maps.

Basic options (parameters), default settings are:

* Map mode -> Link map icon only
* Map State -> [empty field]
* Map Country -> [empty field]
