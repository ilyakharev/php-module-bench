<?php

use Prometheus\CollectorRegistry;

require_once 'vendor/autoload.php';
require_once 'Jwt.php';
$privateKey = '-----BEGIN OPENSSH PRIVATE KEY-----
b3BlbnNzaC1rZXktdjEAAAAABG5vbmUAAAAEbm9uZQAAAAAAAAABAAABlwAAAAdzc2gtcn
NhAAAAAwEAAQAAAYEAzCK0FwOYf4Thm34pNzULlz4AnXV8nahmzLyuZFy00GKHtZO3cdbL
bdLt6opqo0TH2LG73Uqt85t1z7z4lu/I6RGHNBoKiq0e9KcTu7jrAX0u6plQIWfa28GdJ1
JUQJLA2ZBj/QEbvOZiqoaJ6HzACzhwRXdU4MGY4SNbABGr6Bw+phn6YEFpV1UESGgayiHe
48Q37n0TT9RqID6HCQxF+hkGxZd3g46nQul/6PQK1+mgBL2ijDtjPtXZkiXrKAazeMmXUL
zz9Nz7w0Olz2ZAisudC6qaaVny6Rg6X6wjkTW22Ga5+6W1wnMcFeJf9xJh9bRLCgAV/EJc
itt1R5cw8CNzE/S3ii0Pfh8VGObJx1Oa+7Hw9HY3D7j8oohk8rqRXtiowRM5W52BDwwDIg
e1nl3s6XzqcqPaeFCYuuiGawJ7ZbTYmtIJ6198SbtYCf9bbDh+SSunCa0UCulL5QO1OuLn
wi5F6DqK1K69FfIAttI6R5DzuPcD7fk89k5git2PAAAFkFkyouBZMqLgAAAAB3NzaC1yc2
EAAAGBAMwitBcDmH+E4Zt+KTc1C5c+AJ11fJ2oZsy8rmRctNBih7WTt3HWy23S7eqKaqNE
x9ixu91KrfObdc+8+JbvyOkRhzQaCoqtHvSnE7u46wF9LuqZUCFn2tvBnSdSVECSwNmQY/
0BG7zmYqqGieh8wAs4cEV3VODBmOEjWwARq+gcPqYZ+mBBaVdVBEhoGsoh3uPEN+59E0/U
aiA+hwkMRfoZBsWXd4OOp0Lpf+j0CtfpoAS9oow7Yz7V2ZIl6ygGs3jJl1C88/Tc+8NDpc
9mQIrLnQuqmmlZ8ukYOl+sI5E1tthmufultcJzHBXiX/cSYfW0SwoAFfxCXIrbdUeXMPAj
cxP0t4otD34fFRjmycdTmvux8PR2Nw+4/KKIZPK6kV7YqMETOVudgQ8MAyIHtZ5d7Ol86n
Kj2nhQmLrohmsCe2W02JrSCetffEm7WAn/W2w4fkkrpwmtFArpS+UDtTri58IuReg6itSu
vRXyALbSOkeQ87j3A+35PPZOYIrdjwAAAAMBAAEAAAGBALlpk/WLWIoKofhfwQPZ9Gss79
YVDlkMykKP5j5WTg0wUV9Fikul8yQPf/WWP4GISZSy6pX27MTloT5Mv+YoaW34c7uJI6YN
1J4W2z+YmCvEDkcbdcLB1/Hei+VZTBlSskNqeMcmqJENGPUWOlCmbrBCVQdjef6jGT70pA
UOB/xNG0I3OkkPYKToHXm+xQZveUmbwcmmZVIO903OPUykjzK4ZIQ4LV+axKVr/LgUYXz3
QFbN/8QrdNtv1ax/MHYsjlriqFov5rhOl4gIzxlyQ5Azfn92mexfN7N/SXovqrheXcx1Dm
xTomaNIrcD38duR5v4khnYr7IpsmjryppSxINohivHMLcV+S4YCIIp16q/2qNGuEzJt9Mc
EF+MZ0VVDfHMxdj9LZ7m0+qRtwuErN0lgHFMdzVdcs45BbXRp/HY+CzdJMPDY0AntMiGHT
CDLDcND6rUoDsxJkm0yqDZhAgrKLXYdOzz3L5+igfdccS8HGWfCyuSXunW7dtSozNccQAA
AMEAwvK3bEXfgOZbf6y7vULYRj33dk3mba5VOa1QlA7kKZtJ0yQ8PyvzYLq2BChKGGlTqk
/R7NkA7cioWj7i/Vhj7RNiFKWGT2nyeyPjhqwBdEPvXUV+piJkktO8Q5N0GAU6JXKN1NXI
FI4zLL309975QVfW64p1PFnROz/IGeT1YhO19HppyJwAPuC7oweJsSuQhh35cDgvtkf4/W
FOoCpcSSk1xMdsSh+zBv95JaMDsbKAlCZAFU2bpqyHncOoV8X2AAAAwQDyKCE/eX6Ogyby
HcduosM/M4E+Gi3WB39E8QLYICACcUVK0LdOGroTRI5Jto4mD6udeHH3g3Ci9YD5meTqvy
ESXtIRSlHPUCxJBkbl2QoRqSUixMN1EksW5fHN3d9cSNtdcx1Ed7oOXrk8rphSXpSad1Gv
B0f70aplZYdNnWffG6rKPA+1QeSgUjMujgDYB7/6TkTZ0sWAApyi2RwmfPDzfgathA/jjv
svUjJg/H+VnNR726RBIb9BLNFZCzZnMBUAAADBANfOJez3Cne+43QkClIitbwjLgQx3T+D
zjoT8iL3mnv4CIlVUQD71C+4r2BVl7WL48Ij/wuK0qGE6xt17jpdOTQLCEJIkHOJvN8G+P
A4YKeAaUsRehpO1l7e2HIx/Q+F5rphof9RE4tlbC+ui9OBsvQ4FozUgS2LPC1kyzGe1i1r
0zSjRtUz6OWc43jvk3Yw5+Ro5HI1zOdwksxDd0Yo0dgu1WVXBB27HREUFRUkDCsvxH0I4r
yTljbZjBd3nyAcEwAAABhpbHlha2hhcmV2QGlseWFraGFyZXYtb3MB
-----END OPENSSH PRIVATE KEY-----
';
$keyId = 'ljgfhe8o5t359ureoth';
$serviceId = 'gdfkjh39748tihorelg';
$now = new DateTimeImmutable();
$latency = [];
$registry = new CollectorRegistry(new \Prometheus\Storage\InMemory);
$pushGateway = new \PrometheusPushGateway\PushGateway('http://158.160.25.12:9091');
$summary = $registry->getOrRegisterSummary('', 'sing_latancy', '', ['version', 'ext'], 600, [0.5,0.99]);
for ($i = 0; $i < 10001; $i++) {
    $start = microtime(true);
    $token = (new Jwt($privateKey, $keyId))
        ->issuedBy($serviceId)
        ->issuedAt($now)
        ->expiresAt($now->modify('+1 hour'))
        ->permittedFor('http://169.254.169.254/computeMetadata/v1/instance/service-accounts/default/token')
        ->getToken();
    if($i!=0) {
        $summary->observe((microtime(true) - $start) * 1000, [$argv[1], $argv[2]]);
    }
}
$pushGateway->push($registry, $argv[1].'-'.$argv[2]);