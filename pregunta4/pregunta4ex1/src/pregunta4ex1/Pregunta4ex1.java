package pregunta4ex1;

public class Pregunta4ex1 {

    public static void main(String[] args) {
        if (args.length == 0) {
            System.out.println("Error: No se proporciono el codigo catastral.");
            return;
        }

        String codigoCatastral = args[0];
        String tipoImpuesto = calcularTipoImpuesto(codigoCatastral);

        System.out.println(tipoImpuesto);
    }

    private static String calcularTipoImpuesto(String codigoCatastral) {
        switch (codigoCatastral.charAt(0)) {
            case '1':
                return "Alto";
            case '2':
                return "Medio";
            case '3':
                return "Bajo";
            default:
                return "Desconocido";
        }
    }
}