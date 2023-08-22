const fs = require('fs')
let lines = fs.readFileSync('./data4.txt').toString().split("\n")
const info = {}
for (let line of lines) {
    let args = line.substring('sing_latancy'.length).split(' ')
    let data = JSON.parse(args[0])
    let sing = Number.parseFloat(args[1])
    if (info[data.version]===undefined){
        info[data.version] = {}
    }
    if (info[data.version][data.ext]===undefined){
        info[data.version][data.ext] = {}
    }
    info[data.version][data.ext][data.quantile] = Number.parseFloat(args[1])
}
let table = `| ext     | sin q=0.5  | sin q=0.99 | smr q=0.5  | smr q=0.99 |
|---------|------------|------------|------------|------------|\n`
for (const version in info) {
    table += `| PHP ${version} |\n`
    for (const module in info[version]) {
        table += '|'
        table += module.padEnd('---------'.length)
        table += '|'
        table += info[version][module]["0.5"].toString().padEnd('---------'.length)
        table += '|'
        table += info[version][module]["0.99"].toString().padEnd('---------'.length)
        table += '|'
        table += (info[version][module]["0.5"]/info[version]["clear"]["0.5"]).toString().padEnd('---------'.length)
        table += '|'
        table += (info[version][module]["0.99"]/info[version]["clear"]["0.99"]).toString().padEnd('---------'.length)
        table += '|\n'
    }
}
console.log(table)