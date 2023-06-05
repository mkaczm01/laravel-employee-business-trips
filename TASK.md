# Recruitment task

• proof your skills across all areas

• use any PHP framework

• use what you think is crucial to designing a maintainable and testable software.

• consider using the following patterns: DDD (in particular, separating subdomains and the Bounded Context pattern), hexagonal architecture, MVC and framework-agnostic

• there is no time limit for completing the task

• the task solution is for recruitment purposes only and will not be used in the future

# Task

Implement an API for a simple system to calculate the amount of per diem due for a business trip for an employee at company X.

# Business assumptions

• business trips can only take place to the following countries, where the following per diem rates apply for a given day: - PL: 10 PLN - DE: 50 PLN - GB: 75 PLN

• the start date of the business trip cannot be later than the end date of the business trip

• an employee can only be on one business trip at a time

• a per diem is due for if an employee spends at least 8 hours on a business trip on that day

• no per diem is due for Saturday and Sunday

• if a business trip lasts more than 7 calendar days, then the per diem rate for each day following the 7th calendar day is doubled.

# Required endpoints

• (POST) adding an employee to the system. No input data, an employee identifier is returned in response

• (POST) adding a business trip for a user, with input data:

- business trip start date and time

- business trip end date and time

- employee identifier

- country code to which the business trip takes place in ISO 3166-1 alpha-2 format

• (GET) list of business trips for a user entered on input, along with the total amount of per diem due for each business trip in format:

```json
[
  {
    "start": "2020-04-20 08:00:00",
    "end": "2020-04-21 16:00:00",
    "country": "PL",
    "amount_due": 20,
    "currency": "PLN"
  },
  {
    "start": "2020-04-24 20:00:00",
    "end": "2020-04-28 16:00:00",
    "country": "DE",
    "amount_due": 150,
    "currency": "PLN"
  }
]
```
