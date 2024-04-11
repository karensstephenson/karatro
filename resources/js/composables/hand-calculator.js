export function useHandCalculator() {
    // Assume you as passing an array of n cards (up to 5) in the form object { value: 2, suit: 'hearts', rank: '2 }
    // Each function listed below is in order of important, e.g. a 4 of a kind would override a full house
    // because four of a kind is deemed to be a better hand.

    // All of the functions below should return a boolean value, true if the hand is that type, false otherwise.

    const sortCards = (cards) => cards.sort((a, b) => a.rank - b.rank);
        
    const rankOrder = [
        "14",
        "13",
        "12",
        "11",
        "10",
        "9",
        "8",
        "7",
        "6",
        "5",
        "4",
        "3",
        "2",
    ];

    // Straight flush: Five cards in a sequence, all in the same suit.
    const isStraightFlush = (cards) => {
        if (!cards.every((card) => card.suit === cards[0].suit)) {
            return false;
        }
        sortCards(cards)

        //Checks for low ace
        if (
            cards.length === 5 &&
            cards[4].rank === 14 &&
            cards[0].rank === 2 &&
            cards[1].rank === 3 &&
            cards[2].rank === 4 &&
            cards[3].rank === 5
        ) {
            return true;
        }

        for (let i = 1; i < cards.length; i++) {
            if (cards[i].rank !== cards[i - 1].rank + 1) {
                return false;
            } else {
                return true
            }
        }
        
    };

    // Four of a kind: Four cards of the same rank
    const isFourOfAKind = (cards) => {
        const rankCounts = {};
        for (const card of cards) {
            if (rankCounts[card.rank]) {
                rankCounts[card.rank] += 1;
            } else {
                rankCounts[card.rank] = 1;
            }
        }
        for (const rank in rankCounts) {
            if (rankCounts[rank] === 4) {
                return true;
            }

            return false;
        }
    };

    // Full house: Three cards of one rank and two cards of another rank.
    const countEachRank = () => {
        
    }
    
    const isFullHouse = (cards) => {
        const rankCounts = {};
        for (const card of cards) {
            if (rankCounts[card.rank]) {
                rankCounts[card.rank] += 1;
            } else {
                rankCounts[card.rank] = 1;
            }
        }
        let hasPair = false;
        let hasThreeOfAKind = false;
        for (const key in rankCounts) {
            if (rankCounts[key] === 2) {
                hasPair = true;
            }
            if (rankCounts[key] === 3) {
                hasThreeOfAKind = true;
            }
        }
        return hasPair && hasThreeOfAKind;
    };

    // Flush: Five cards of the same suit, not in sequence
    const isFlush = (cards) => {
        if (cards.every((card) => card.suit === cards[0].suit)) {
            return true;
        } else {
            return false;
        }
    };

    // Straight: Five cards in a sequence, but not of the same suit.
    const isStraight = (cards) => {
        sortCards(cards)

        //Checks for low ace
        if (
            cards.length === 5 &&
            cards[4].rank === 14 &&
            cards[0].rank === 2 &&
            cards[1].rank === 3 &&
            cards[2].rank === 4 &&
            cards[3].rank === 5
        ) {
            return true;
        }

        for (let i = 1; i < cards.length; i++) {
            if (cards[i].rank !== cards[i - 1].rank + 1) {
                return false;
            }
        }
        return true;
    };

    // Three of a kind: Three cards of the same rank
    const isThreeOfAKind = (cards) => {
        const rankCounts = {};
        for (const card of cards) {
            if (rankCounts[card.rank]) {
                rankCounts[card.rank] += 1;
            } else {
                rankCounts[card.rank] = 1;
            }
        }
        for (const rank in rankCounts) {
            if (rankCounts[rank] === 3) {
                return true;
            }

            return false;
        }
    };

    // Two pair: Two cards of one rank and two cards of another rank
    const isTwoPair = (cards) => {
        const rankCounts = {};
        for (const card of cards) {
            if (rankCounts[card.rank]) {
                rankCounts[card.rank] += 1;
            } else {
                rankCounts[card.rank] = 1;
            }
        }
        
        let pairs = 0;
        for (const key in rankCounts) {
            if (rankCounts[key] === 2) {
                pairs++;

                if (pairs === 2) {
                    return true;
                }
            }
        }
        return false;
    };

    // Pair: Two cards of the same rank
    const isPair = (cards) => {
        const ranks = [];
        for (const card of cards) {
            if (ranks.includes(card.rank)) {
                return true;
            } else {
                ranks.push(card.rank);
            }
        }
        return false;
    };

    // High card: Highest value card (last ditch saloon, if none of those above apply, this one will)
    const isHighCard = (cards) => {
        sortCards(cards)
        console.log(cards[0]);
        return true;
    };

    const getHandName = (cards) => {
        if (isStraightFlush(cards)) {
            return "Straight Flush";
        } else if (isFourOfAKind(cards)) {
            return "Four of a Kind";
        } else if (isFullHouse(cards)) {
            return "Full House";
        } else if (isFlush(cards)) {
            return "Flush";
        } else if (isStraight(cards)) {
            return "Straight";
        } else if (isThreeOfAKind(cards)) {
            return "Three of a Kind";
        } else if (isTwoPair(cards)) {
            return "Two Pair";
        } else if (isPair(cards)) {
            return "Pair";
        } else if (isHighCard(cards)) {
            return "High Card";
        }
    };

    return {
        getHandName,
    };
}
