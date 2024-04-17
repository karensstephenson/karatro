export function useHandCalculator() {
    // Assume you as passing an array of n cards (up to 5) in the form object { value: 2, suit: 'hearts', rank: '2 }
    // Each function listed below is in order of important, e.g. a 4 of a kind would override a full house
    // because four of a kind is deemed to be a better hand.

    // All of the functions below should return a boolean value, true if the hand is that type, false otherwise.

    const sortCards = (cards) => cards.sort((a, b) => a.rank - b.rank);
    const lowAceCheck = (cards) => {
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
    };

    // Royal flush: Five cards in a sequence, A,K,Q,J,10 all in the same suit.
    const isRoyalFlush = (cards) => {
        if (!cards.every((card) => card.suit === cards[0].suit)) {
            return false;
        }
        sortCards(cards);

        if (
            cards.length === 5 &&
            cards[0].rank === 14 &&
            cards[1].rank === 13 &&
            cards[2].rank === 12 &&
            cards[3].rank === 11 &&
            cards[4].rank === 10
        ) {
            return true;
        }
        return false;
    };

    // Straight flush: Five cards in a sequence, all in the same suit.
    const isStraightFlush = (cards) => {
        if (!cards.every((card) => card.suit === cards[0].suit)) {
            return false;
        }
        sortCards(cards);

        lowAceCheck(cards);

        if (cards.length === 5) {
            for (let i = 1; i < cards.length; i++) {
                if (cards[i].rank !== cards[i - 1].rank + 1) {
                    return false;
                }
            }
            return true;
        }

        return false;
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
        }
        return false;
    };

    // Full house: Three cards of one rank and two cards of another rank.
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
        let fullHouse = false;
        for (const key in rankCounts) {
            if (!fullHouse) {
                if (rankCounts[key] === 2) {
                    hasPair = true;
                }
                if (rankCounts[key] === 3) {
                    hasThreeOfAKind = true;
                }
                if (hasPair && hasThreeOfAKind) {
                    fullHouse = true;
                }
            }
        }
        return fullHouse;
    };

    // Flush: Five cards of the same suit, not in sequence
    const isFlush = (cards) =>
        cards.every((card) => card.suit === cards[0].suit) &&
        cards.length === 5;

    // Straight: Five cards in a sequence, but not of the same suit.
    const isStraight = (cards) => {
        sortCards(cards);

        lowAceCheck(cards);

        if (cards.length === 5) {
            for (let i = 1; i < cards.length; i++) {
                if (cards[i].rank !== cards[i - 1].rank + 1) {
                    return false;
                }
            }
            return true;
        }
        return false;
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
        }
        return false;
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

    const getHandName = (cards) => {
        if (isRoyalFlush(cards)) {
            return "royalFlush";
        } else if (isStraightFlush(cards)) {
            return "straightFlush";
        } else if (isFourOfAKind(cards)) {
            return "fourOfAKind";
        } else if (isFullHouse(cards)) {
            return "fullHouse";
        } else if (isFlush(cards)) {
            return "flush";
        } else if (isStraight(cards)) {
            return "straight";
        } else if (isThreeOfAKind(cards)) {
            return "threeOfAKind";
        } else if (isTwoPair(cards)) {
            return "twoPair";
        } else if (isPair(cards)) {
            return "pair";
        } else if (cards.length >= 1) {
            return "highCard";
        } else {
            return "noCards";
        }
    };

    return {
        getHandName,
    };
}

export const handDetails = {
    noCards: {
        name: "",
        mult: 0,
        chips: 0,
    },
    highCard: {
        name: "High Card",
        mult: 1,
        chips: 5,
    },
    pair: {
        name: "Pair",
        mult: 2,
        chips: 10,
    },
    twoPair: {
        name: "Two Pair",
        mult: 2,
        chips: 20,
    },
    threeOfAKind: {
        name: "Three of a Kind",
        mult: 3,
        chips: 30,
    },
    straight: {
        name: "Straight",
        mult: 4,
        chips: 30,
    },
    flush: {
        name: "Flush",
        mult: 4,
        chips: 35,
    },
    fullHouse: {
        name: "Full House",
        mult: 4,
        chips: 40,
    },
    fourOfAKind: {
        name: "Four of a Kind",
        mult: 7,
        chips: 60,
    },
    straightFlush: {
        name: "Straight Flush",
        mult: 8,
        chips: 100,
    },
    royalFlush: {
        name: "Royal Flush",
        mult: 8,
        chips: 100,
    },
};
