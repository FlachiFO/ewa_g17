<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="2.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	
	
	<xsl:template match="/">
		<html>
			<head>
				<title>Buecherliste</title>
			</head>
			<body>
				<h1>Buecherliste</h1>
				<table border="1">
					<tr bgcolor="yellow">
						<th>Produkttitel</th>
						<th>Produktcode</th>
						<th>Gewicht</th>
						<th>Lagerbestand</th>
						<th>Autorname</th>
						<th>Verlagsname</th>
						<th>Nettopreis</th>
						<th>Bruttoreis</th>
					</tr>
					<xsl:for-each select="Produktkatalog/Produkt">
					<tr>
						<td> <xsl:value-of select="Allgemein/Produkttitel" /> </td>
						<td> <xsl:value-of select="Allgemein/Produktcode" /> </td>
						<td> <xsl:value-of select="Allgemein/Gewicht" /></td>
						<td> <xsl:value-of select="Allgemein/Lagerbestand" /> </td>
						<td> <xsl:value-of select="Autor/Autorname" /> </td>
						<td> <xsl:value-of select="Verlag/Verlagsname" /> </td>
						<td> <xsl:value-of select="Preisdaten/PreisNetto" /> </td>
						<td> <xsl:value-of select="Preisdaten/PreisBrutto" /> </td>
					</tr>
					</xsl:for-each>
				</table>
			</body>
		</html>
	</xsl:template>
	
	
	
</xsl:stylesheet>