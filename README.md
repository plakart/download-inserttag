# Download Insert-Tag für das CMS Contao
Dieses Bundle fügt für Inhaltselemente etc. einen neuen Download Insert-Tag hinzu.

## Usage
```
{{download::path|uuid::linkname}}
```

`path` (Realativer Pfad der Datei aus der Dateiverwaltung) oder `uuid` (Datenbank-ID der Datei aus der Dateiverwaltung) sind Pflichtangaben. `linkname` ist ein optionaler Parameter. Wird dieser nicht angegeben, wird der Dateiname angezeigt.

## Versionshinweis
- 1.0.0 Contao 4
- 2.0 Contao 5