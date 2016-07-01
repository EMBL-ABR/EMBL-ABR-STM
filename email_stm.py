import json, time, requests

MAIL_URL = ""
API_KEY = ""
FROM = ""
SEND_TO = ""
FILE_PATH = ""



def send_simple_message():
    msg = "\nEMBL-ABR STM Daily Update - " + time.strftime("%c") + "\n\n"
    with open(FILE_PATH+'limit.json') as data_file:
        data = json.load(data_file)
        msg += "Current limit count: " + str(data['limit']) + "\n\n"

    with open(FILE_PATH+'query_log.txt') as data_file:
        with open(FILE_PATH+'query_log_all.txt', "a") as data_file_all:
            lines = data_file.readlines()
            msg += "Queries in the last 24 hours: " + str(len(lines)) +  "\n"
            for line in lines:
                msg += line
                data_file_all.write(line)
            msg += "\n"

    with open(FILE_PATH+'requests.json') as data_file:
        with open(FILE_PATH+'requests_all.txt', "a") as data_file_all:
            data = json.load(data_file)
            num_reqs = len(data)
            msg += "Number of new requests: " + str(num_reqs) + "\n\n"
            if num_reqs:
                i = 1
                for line in data:
                    data_file_all.write(line + "\n")
                    split_line = [x.strip() for x in line.replace("{", "").replace("}", "").replace("\'", "").replace("\"", " ").replace(":", ",").split(",")]
                    msg += "--- Request " + str(i) + " ---\n"
                    msg += "Email: " + str(split_line[1]) + "\n"
                    msg += "URL: " + str(split_line[3]) + "\n"
                    msg += "Reason: " + str(split_line[5]) + "\n"
                    msg += "\n"
                    i+=1

    open(FILE_PATH+'query_log.txt', "w").close()
    data_file = open(FILE_PATH+'requests.json', "w")
    data_file.write("[]")
    data_file.close()


    requests.post(url= MAIL_URL, auth=("api", API_KEY),
                  data={"from": FROM, "to": SEND_TO, "subject": "Daily STM Update", "text": msg})


if __name__ == "__main__":
    send_simple_message()
