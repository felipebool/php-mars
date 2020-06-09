# PHP Mars 24h
This project is based on Nasa's Mars24 Sunclock. It provides a simple interface 
for converting UTC to Mars Sol Date and Martian Coordinated Time (MTC).

## Dependencies
You need to have Docker and Docker compose installed on your local machine in
order to try this project.

## How to use it
* Clone this repo
* Go to the repository directory
* Run `docker-compose up`

### Sending requests
After running `docker-compose up`, you can start sending requests. I tried to
make the interface as simple as possible, thus, POST verb was used instead of GET
to send the date string to be converted.

The POST data must contain only one field called `date` filled with a string
representing the date you want to convert.

## Return messages
There are two possible errors (discounting 50x errors, : D)
* `Unknown date format` (400), when `DateTime` does not recognize the date string
* `Missing date field` (400), when `date` field is missing from POST data. 

## References
* [Nasa's Mars24 Sunclock](https://www.giss.nasa.gov/tools/mars24/)
* [Nasa's Algorithm and worked examples for Mars24 Sunclock](https://www.giss.nasa.gov/tools/mars24/help/algorithm.html)
* [Mars Clock by James Tauber](https://jtauber.github.io/mars-clock/)
