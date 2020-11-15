using System;

namespace ConcurrencyTimestamp
{
    class Program
    {
        static void Main(string[] args)
        {
            UserInterface ui = new UserInterface();
            ui.ShowUserInput();

            // H1 = r1[x] - r2[x] - w1[y] - w2[x] - w2[y]
            // H2 = w1[x] - w2[y] - r1[y] - r2[x]
            // H3 = r1[x] - r2[y] - w2[y] - w3[z] - r2[x] - r3[y] - r1[y] - w1[y] - w1[x]
        }
    }
}
