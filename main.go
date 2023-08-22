package main

import (
	"fmt"
	"io/ioutil"
	"net/http"
	"os/exec"
	"strings"
)

func main() {
	phpVersions := []string{"7.2", "7.4", "8.0", "8.2"}
	modules := map[string]string{
		"clear":     "echo VERSION",
		"apcu":      "apt-get install -y phpVERSION-apcu",
		"xdebug":    "apt-get install -y phpVERSION-xdebug",
		"gd":        "apt-get install -y phpVERSION-gd",
		"imagick":   "apt-get install -y phpVERSION-imagick",
		"mbstring":  "apt-get install -y phpVERSION-mbstring",
		"mysqlnd":   "apt-get install -y phpVERSION-mysqlnd",
		"simplexml": "apt-get install -y phpVERSION-SimpleXML",
		"gmp":       "apt-get install -y phpVERSION-gmp",
		"bcmath":    "apt-get install -y phpVERSION-bcmath",
		"emil":      "apt-get install -y phpVERSION-imagick phpVERSION-mbstring phpVERSION-mysqlnd phpVERSION-bcmath",
		//"aerospike": `apt-get install -y build-essential autoconf libssl-dev phpVERSION-dev php-pear; \
		//composer require aerospike/aerospike-client-php; \
		//find vendor/aerospike/aerospike-client-php/ \-name "*.sh" \-exec chmod +x {} \; \
		//cd vendor/aerospike/aerospike-client-php/ && composer run-script post-install-cmd; \
		//ls; \
		//cd src && ./build.sh; \
		//cd src && make install && php \-i | grep ".ini "; \
		//echo 'extension=aerospike.so
		//aerospike.udf.lua_user_path=/usr/local/aerospike/usr-lua' >> /etc/php/VERSION/cli/conf.d/aerospike.ini`,
	}
	//app := "docker"
	for _, version := range phpVersions {
		for key, _ := range modules {
			url := "http://158.160.25.12:9091/metrics/job/" + version + "-" + key
			method := "DELETE"

			client := &http.Client{}
			req, err := http.NewRequest(method, url, nil)

			if err != nil {
				fmt.Println(err)
				return
			}
			res, err := client.Do(req)
			if err != nil {
				fmt.Println(err)
				return
			}
			defer res.Body.Close()

			body, err := ioutil.ReadAll(res.Body)
			if err != nil {
				fmt.Println(err)
				return
			}
			fmt.Println(string(body))

		}
	}
	for _, version := range phpVersions {
		for key, value := range modules {
			preload := strings.Replace(value, "VERSION", version, -1)
			println(preload)
			cmd := exec.Command("docker", "build", "-t", "ubuntu-"+key+":"+version, "--build-arg", "PHP="+version,
				"--build-arg", "PRELOAD="+preload+"", ".")
			//cmd.Wait()
			stdout, err := cmd.Output()
			if err != nil {
				fmt.Println(string(stdout))
				fmt.Println(err.Error())
			}
			// Print the output
			//fmt.Println(string(stdout))
			println("ubuntu-" + key + ":" + version)
			cmd = exec.Command("docker", "run", "--rm", "ubuntu-"+key+":"+version, version, key)
			//cmd.Wait()
			stdout, err = cmd.Output()
			if err != nil {
				fmt.Println(string(stdout))
				fmt.Println(err.Error())
			}
			// Print the output
			//fmt.Println(string(stdout))
		}
	}
}
