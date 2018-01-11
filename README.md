# About

This module provides form element 'time' and 'Time Range' field.

## Form element 'time'
Uses Input type="time" with min="00:00", max="23:59", pattern="[0-9]{2}:[0-9]{2}".
See example at https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/time#Validation.

## Time Range field
Field with start and end time. Both fields are optional, but end time won't be shown if start date is empty.

Examples:

* Default output:

```
08:00 - 17:00 hour
```

* Alternate output:
```
08.00/17.00
```


# TODO

* Field value validation on submit, as we rely on the format of 'hh:mm'.